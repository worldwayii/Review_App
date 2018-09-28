@extends('layouts.master')
@section('title','User Reviews')
@section('body')
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">
                    <div class="cart-title">
                        <h2>Friend List</h2>
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
                    <div style=" box-shadow: 0px 0px 5px 0px; padding-top: 10px;">
                        @foreach($reviews as $review)
                        <div class="col-sm-12">
                            
                            <div class="col-sm-8">
                                <p><b>Item Reviwed:</b> <a href="{{ url('item/'.$review->item->sku) }}">{{$review->item->name}}</a></p>
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
                            </div>
                            <div class="col-sm-8">
                                <h4><a>{{$review->comment}}</a></h4>
                            </div>
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
                            
                        </div>
                        <div class="clearfix"></div>
                        <hr />
                        @endforeach
                    </div>
                    
                    
                </div>
            </div>
            <div class="col-12 col-lg-4">
                
            </div>
        </div>
    </div>
</div>
</div>
@endsection