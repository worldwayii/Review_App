@extends('layouts.master')
@section('body')
<div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Register</h2>
                            </div>
                                        @if(Session::has('success'))
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                            {{Session::get('success')}}
                                        </div>
                                        @elseif(Session::has('fail'))
                                        <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                            {{Session::get('fail')}}
                                        </div>
                                        @endif
                            <form method="POST" action="{{route('register')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-12 mb-3 {{ ($errors->has('full_name')) ? 'has-error' : ''}}">
                                        <input type="text" class="form-control" name="full_name" value="{{old('full_name')}}" placeholder="Full Name" required>
                                        @if ($errors->has('full_name'))
                                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('full_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 mb-3 {{ ($errors->has('email')) ? 'has-error' : ''}}">
                                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                                        @if ($errors->has('email'))
                                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 mb-3 {{ ($errors->has('date_of_birth')) ? 'has-error' : ''}}">
                                        <input type="date" class="form-control" name="date_of_birth" placeholder="Date Of Birth" value="{{old('date_of_birth')}}">
                                        @if ($errors->has('date_of_birth'))
                                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('date_of_birth') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-12 mb-3 { ($errors->has('user_type')) ? 'has-error' : ''}}">
                                        <select  class="w-100" name="user_type">
                                          <option> <-- Select User Type --> </option>
                                          @foreach($roles as $role)
                                          <option value="{{$role->id}}">{{$role->name}}</option>
                                          @endforeach
                                        </select>
                                        @if ($errors->has('user_type'))
                                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('user_type') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 mb-3 {{ ($errors->has('password')) ? 'has-error' : ''}}">
                                        <input type="password" class="form-control" name="password" placeholder="**********" value="">
                                        @if ($errors->has('password'))
                                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 mb-3 {{ ($errors->has('password_confirmation')) ? 'has-error' : ''}}">
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="**********" value="">
                                        @if ($errors->has('password_confirmation'))
                                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="custom-control custom-checkbox d-block mb-2">
                                           
                                        </div>
                                        <div class="custom-control custom-checkbox d-block">
                                            
                                        </div>
                                        <button type="submit" class="btn btn-large d-block mb-2" style="background-color:#f5bd22;">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection