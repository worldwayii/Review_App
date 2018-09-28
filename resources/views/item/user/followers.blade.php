@extends('layouts.master')
@section('title','Who I Follow')
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
                        @foreach($followers as $follower)
                        <div class="col-sm-12">
                            <div class="col-sm-2">
                                <img src="https://www.infrascan.net/demo/assets/img/avatar5.png" class="img-rounded" width="60px">
                            </div>
                            <div class="col-sm-8">
                                <h4><a>{{$follower->user->full_name}}</a></h4>
                                <h6><a>{{$follower->user->email}}</a></h8>
                            </div>
                           <a href="{{url('user/reviews/'.$follower->user->id)}}"><button class="btn btn-info">View Reviews</button></a>
                           <a href="{{url('user/followers/'.$follower->user->id)}}"><button class="btn btn-info">View Friend List</button></a>
                        </div>
                        <div class="clearfix"></div>
                        <hr />
                        @endforeach
                    </div>
                    
                    
                </div>
            </div>
            <div class="col-12 col-lg-4" style="margin-top: 120px;">
                    <div style=" box-shadow: 0px 0px 5px 0px; padding: 10px;">
                       <h6>People You May Follow</h6>
                         @foreach($recommends->slice(1, 3) as $recommendedUser)
                            @if($recommendedUser->user->id != Auth::user()->id)
                                <div class="col-sm-2">
                                    <img src="https://www.infrascan.net/demo/assets/img/avatar5.png" class="img-rounded" width="60px"> {{$recommendedUser->user->full_name}}
                                    <a href="{{url('follow/'.$recommendedUser->user->id)}}">
                                        <button class="btn-info" >  Follow
                                        </button>
                                    </a>
                                </div>
                            @endif
                          @endforeach
                    </div>
                
            </div>
        </div>
    </div>
</div>
</div>

@endsection