<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::has('images')->with('images')->get();
        return view('index', compact('items'));
    }
}
