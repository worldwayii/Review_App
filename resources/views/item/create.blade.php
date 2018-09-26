@extends('layouts.master')
@section('title','Create Item')
@section('body')
<div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Create Item</h2>
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
                            <form method="POST" action="{{url ('item/add')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-12 mb-3 {{ ($errors->has('item_name')) ? 'has-error' : ''}}">
                                        <input type="text" class="form-control" name="item_name" value="{{old('item_name')}}" placeholder="Item Name" required>
                                        @if ($errors->has('item_name'))
                                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('item_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 mb-3 {{ ($errors->has('price')) ? 'has-error' : ''}}">
                                        <input type="number" class="form-control" name="price" placeholder="Price" value="{{old('price')}}" required>
                                        @if ($errors->has('price'))
                                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('price') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 mb-3 {{ ($errors->has('manufacturer')) ? 'has-error' : ''}}">
                                        <input type="text" class="form-control" name="manufacturer" placeholder="Manufacturer" value="{{old('manufacturer')}}" required>
                                        @if ($errors->has('manufacturer'))
                                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('manufacturer') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 mb-3 {{ ($errors->has('url')) ? 'has-error' : ''}}">
                                        <input type="url" class="form-control" name="url" placeholder="Url" value="{{old('url')}}" required>
                                        @if ($errors->has('url'))
                                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('url') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12 mb-3 {{ ($errors->has('about')) ? 'has-error' : ''}}">
                                        
                                        <textarea name="about"  class="form-control" placeholder="About Item" id="" cols="30" rows="10" maxlength="220">{{old('about')}}</textarea>
                                        @if ($errors->has('about'))
                                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('about') }}</span>
                                        @endif
                                    </div>
                                    
                                    <div class="col-12 mb-3 {{ ($errors->has('path')) ? 'has-error' : ''}}">
                                        <input type="file" class="form-control" id="file" name="path" placeholder="Url" required>
                                        @if ($errors->has('path'))
                                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('path') }}</span>
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

