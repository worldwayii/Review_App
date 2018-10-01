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
                    <div id="product_details_sliderproduct_details_slider" class="carousel slide" data-ride="carousel">
                        @if(count($item->images) == 1)
                            <div class="carousel-inner">
                                @foreach($item->images as $image)
                                <div class="carousel-item active">
                                    <a class="gallery_img" href="{{Storage::url($image->path)}}">
                                        <img class="d-block w-100" src="{{Storage::url($image->path)}}" alt="First slide">
                                    </a>
                                </div>
                                <b>Default Image</b>
                                @endforeach
                            </div>
                        @else
                            <div class="carousel-indicators" style="margin-bottom: 15px;">
                                @foreach($item->images as $image)
                                <div class="carousel-item active" style="padding: 4px;">
                                    <a class="gallery_img" href="{{Storage::url($image->path)}}">
                                        <img class="d-block w-100" src="{{Storage::url($image->path)}}" alt="First slide">
                                    </a>
                                </div>
                                @if($image->user_id !== NULL)
                                <div><b>Uploaded by:</b>{{$image->user->full_name}}</div>
                                @else
                                <div><b>Default Image</b></div>
                                @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                </div>
                    <a href="{{ url('item/image/'.$item->sku)}}">
                        <button class="btn btn-large btn-success " >Add more Image</button>
                    </a>
              
                    <h5 style="margin-top: 15px; font-family: helvetica;"><i>Items you may like</i></h5>
            
                      @foreach($recommends->slice(1, 3) as $recommended)
                        @if($recommended->item->id != $item->id)
                            @foreach($recommended->item->images->slice(0, 1) as $recomendImg)
                                <a href="{{url('item/.$recommended->item->sku')}}"><img src="{{Storage::url($recomendImg->path)}}" class="img-rounded" width="60px"></a>
                            @endforeach
                            <h6 style="margin: 5px;">{{$recommended->item->name}}</h6>
                        @endif
                      @endforeach
                    
               
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
                        <h6>Link: <a href="" target="_blank">{{$item->url}}</a></h6>
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
                                @if(Auth::check() && Auth::user()->id !== $review->user_id)
                                    <?php $following = App\Models\Follower::where('follower_id', Auth::user()->id)->where('followee_id', $review->user_id)->first(); ?>
                                    @if($following)
                                        <a href="{{url('unfollow/'.$following->id)}}">
                                            <button class="btn-info" style="float: right; margin-top: 2px;">  Unfollow
                                            </button>
                                        </a>
                                    @else
                                        <a href="{{url('follow/'.$review->user_id)}}">
                                            <button class="btn-info" style="float: right; margin-top: 2px;">  Follow
                                            </button>
                                        </a>
                                    @endif
                                @endif
                                <p>{{$review->comment}}</p>
                                <div >
                                    <a href="{{url('vote/like/'.$review->id)}}"><i class="fa fa-lg fa-thumbs-up"></i>
                                        <?php $likes = 0; ?>
                                        @foreach($review->votes as $vote)
                                            @if($vote->vote == 1)
                                                <?php $likes += 1; ?>
                                            @endif
                                        @endforeach
                                        {{$likes}}
                                    </a>
                                    <a href="{{url('vote/dislike/'.$review->id)}}"><i class="fa fa-lg fa-thumbs-down"></i>
                                     <?php $disLikes = 0; ?>
                                        @foreach($review->votes as $vote)
                                            @if($vote->vote == 0 )
                                                <?php $disLikes += 1; ?>
                                            @endif
                                        @endforeach
                                        {{$disLikes}}
                                    </a>
                                </div>
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