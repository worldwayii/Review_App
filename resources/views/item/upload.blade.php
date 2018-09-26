@extends('layouts.master')
@section('title','Add Image to Item')
@section('body')
<div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Add Image</h2>
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
                            <form method="POST" action="{{url('item/addImage')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="row">
                                   <input type="hidden" value="{{$item->id}}" name="item_id">
                                    
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
                                        <button type="submit" class="btn btn-large d-block mb-2" style="background-color:#f5bd22;">Upload</button>
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

