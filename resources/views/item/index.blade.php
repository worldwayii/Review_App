@extends('layouts.master')
@section('title',' Item')
@section('body')
<!-- Product Details Area Start -->
<div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-7">
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
                <div class="single_product_thumb">
                    <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($item->images as $image)
                            <li class="active" data-target="#product_details_slider" data-slide-to="0"
                                style="background-image: url({{Storage::url($image->path)}});">
                            </li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach($item->images as $image)
                            <div class="carousel-item active">
                                <a class="gallery_img" href="{{Storage::url($image->path)}}">
                                    <img class="d-block w-100" src="{{Storage::url($image->path)}}" alt="First slide">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="single_product_desc">
                    <!-- Product Meta Data -->
                    <div class="product-meta-data">
                        <div class="line">
                        </div>
                        <p class="product-price">${{$item->price}}</p>
                        @if(Auth::check() && Auth::user()->role_id == 2)
                        <div style="float: right;">
                            <a href="{{url('item/delete/'.$item->sku)}}" style="float: right;">
                                <button class="btn btn-danger">Delete</button>
                            </a>
                            <a href="{{url('item/edit/'.$item->sku)}}" style="float: right; padding-right: 3px;">
                                <button class="btn btn-info">Edit</button>
                            </a>
                        </div>
                        @endif
                        <h5>{{$item->name}}</h5>
                        <h6>Link: {{$item->url}}</h6>
                        <h6>Manufacutured By: {{$item->manufacturer->name}}</h6>
                        <!-- Ratings & Review -->
                        <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                            
                            <div class="review">
                                <a href="{{url('item/review/'.$item->sku)}}">Write A Review</a>
                            </div>
                        </div>
                    </div>
                    <div class="short_overview my-5">
                        <p>{{$item->about}}</p>
                    </div>
                    <div class="short_overview my-5">
                        <h3>Reviews</h3>
                        <button class="btn btn-success" style="float: right; padding: 4px" data-toggle="modal" data-target="#myModal"> Sort by Latest review</button>
                        <button class="btn btn-success" style="float: right; padding: 4px" data-toggle="modal" data-target="#ratingModal"> Sort by Highest rating</button>
                        <div>
                            @foreach($itemReviews as $review)
                                <b>By: {{$review->user->full_name}}</b>
                                @if($review->rating == 1)
                                <small class="text-muted">&#9733; </small>
                                @elseif($review->rating == 2)
                                <small class="text-muted">&#9733; &#9733; </small>
                                @elseif($review->rating == 3)
                                <small class="text-muted">&#9733; &#9733; &#9733; </small>
                                @elseif($review->rating == 4)
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; </small>
                                @elseif($review->rating == 5)
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9733; </small>
                                @endif
                                <p>{{$review->comment}}</p>
                                @if(Auth::check())
                                    @if(Auth::user()->id == $review->user_id || Auth::user()->role_id == 2)
                                    <a href="{{url('item/review/edit/'.$review->id)}}"><button class="btn btn-info">Edit</button></a>
                                    <a href="{{url('item/review/delete/'.$review->id)}}"><button class="btn btn-danger">Delete</button><br><br>
                                    @endif
                                @endif
                            @endforeach
                            </div>
                        </div>
                            {{ $itemReviews->links() }}
                        <!-- Add to Cart Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Details Area End -->
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{$item->name}} Reviews By Last Latest</h4>
            </div>
            <div class="modal-body">
                @foreach($reviews as $review)
                    <h6>
                        <b>By: </b>{{$review->user->full_name}} 
                         @if($review->rating == 1)
                            <small class="text-muted">&#9733; </small>
                            @elseif($review->rating == 2)
                            <small class="text-muted">&#9733; &#9733; </small>
                            @elseif($review->rating == 3)
                            <small class="text-muted">&#9733; &#9733; &#9733; </small>
                            @elseif($review->rating == 4)
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; </small>
                            @elseif($review->rating == 5)
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9733; </small>
                            @endif
                    </h6>
                     <h6><b>Created on: </b>{{$review->created_at}}</h6>
                    <p>{{$review->comment}}</p>

                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="ratingModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{$item->name}} Reviews By Highest Rating</h4>
            </div>
            <div class="modal-body">
                @foreach($ratings as $ratin)
                    <h6>
                        <b>By: </b>{{$ratin->user->full_name}} 
                         @if($ratin->rating == 1)
                            <small class="text-muted">&#9733; </small>
                            @elseif($ratin->rating == 2)
                            <small class="text-muted">&#9733; &#9733; </small>
                            @elseif($ratin->rating == 3)
                            <small class="text-muted">&#9733; &#9733; &#9733; </small>
                            @elseif($ratin->rating == 4)
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; </small>
                            @elseif($ratin->rating == 5)
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9733; </small>
                        @endif
                    </h6>
                     <h6><b>Created on: </b>{{$ratin->created_at}}</h6>
                    <p>{{$ratin->comment}}</p>

                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection