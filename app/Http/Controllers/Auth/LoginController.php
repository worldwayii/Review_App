<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        
        $validate = \Validator::make($request->all(), array(
            'email' => 'required',
            'password' => 'required'
        ));
        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        else
        {
            $credentials = $request->only('email', 'password');
            $user = User::where('email', $request->email)->first();

            if ($user == null) {
                $request->session()->flash('fail', 'This email is not registered');                            
                return redirect('register');
            } else {

                if (Auth::attempt($credentials)) {
                    
                    return redirect()->intended('/'); 

                } else {
                    // $request->flash();
                    $request->session()->flash('fail', 'Incorrect login details. Please try again.');                
                    return redirect()->back();
                }

            }
        }

    }


}
