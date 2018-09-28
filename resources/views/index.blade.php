@extends('layouts.master')
@section('title','Home')
@section('body')
<!-- Product Catagories Area Start -->

        <div class="products-catagories-area clearfix">
            <div class="amado-pro-catagory clearfix">
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
                <!-- Single Catagory -->
                @foreach($items as $item)
                    <div class="single-products-catagory clearfix">
                        <a href="{{url('item/'.$item->sku)}}">
                            @foreach($item->images->slice(0, 1) as $image)
                                <img src="{{Storage::url($image->path)}}" alt="">
                            @endforeach
                            <!-- Hover Content -->
                            <div class="hover-content">
                                <div class="line"></div>
                                <p>From ${{$item->price}}</p>
                                <h4>{{$item->name}}</h4>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
        <!-- Product Catagories Area End -->
    </div>
    
@endsection