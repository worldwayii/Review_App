@extends('layouts.master')
@section('title','Review Item')
@section('body')
<div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Review {{$item->name}}</h2>
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
                            <form method="POST" action="{{ url('item/review/store')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="row">
                                   
                                    <div class="col-12 mb-3 {{ ($errors->has('comment')) ? 'has-error' : ''}}">
                                        <input type="hidden" value="{{$item->id}}" name="item_id">
                                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                                        <textarea name="comment"  class="form-control" placeholder="Comment on Item" id="" cols="30" rows="10" maxlength="250">{{old('comment')}}</textarea>
                                        @if ($errors->has('comment'))
                                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('comment') }}</span>
                                        @endif
                                    </div>
                                    <?php $ratings = [1, 2, 3, 4, 5]; ?>
                                    <div class="col-12 mb-3 {{ ($errors->has('rating')) ? 'has-error' : ''}}" style="padding-bottom: 20px;">
                                        <select class="w-100" id="rating" name="rating">
                                        <option> <-- Rating --> </option>
                                        @foreach($ratings as $rating)
                                                <option value="{{$rating}}">{{$rating}}</option>
                                        @endforeach
                                        </select>
                                        @if ($errors->has('rating'))
                                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('rating') }}</span>
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

