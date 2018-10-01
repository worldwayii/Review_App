@extends('layouts.master')
@section('title','Documentation')
@section('body')
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-12" style="border: 2px solid grey">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-title">
                        <h2>Projecct Documentation</h2>
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
                    <p> The Joseph Nwafor review application is designed to review furnitures so enable users decide the best furniture to invest in. The databases where set up using Laravel migration on Sqlite databse and the Images, Items, Manufactures and Roles table where pre seeded with laravel seeders. The user registration works, for both moderators and regular users, and I used the laravel Make:auth class to implement the registration and log in was also implemented. The Log out was also implemented to sign out users. The login can be done from anywhere and it redirects to intended page whenever auth is requested. </p>
                    <p>Items can be created by logged in users. This created items can be reviewed by different users just once. The reviews can be edited at any time. There is modal on the Item details page to show items ordered by rating, and by date. The index page lists all the items, and details on items can be seen when a particular item is clicked. An item can have one picture and more. Some level of authorithy was given based on the role of the user; Moderator oe=r Regular user types(Acess control). This was done on the backend and forntend. When reviews and more than 5, the pagination comes to. Users can like or dislike reviews, They also can follow and unfollow reviewers. The recommendation feature was implemented based on users with the highest views and items with the highest reviews.</p>
                    
                </div>
                <div class="card mt-4" style="margin-bottom: 13px;">
                    <h4 class="card-title">
                        <p class="card-text" style="padding: 4px;">The Entity Relationship Diagram</p>
                    </h4>
                    <img class="card-img-top img-fluid" src="{{asset('database_diagram.png')}}" alt="">
                </div>
            </div>
            
        </div>
    </div>
</div>
</div>
    
@endsection

