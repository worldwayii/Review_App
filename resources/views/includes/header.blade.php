
<!-- ##### Main Content Wrapper Start ##### -->
<div class="main-content-wrapper d-flex clearfix">
    <!-- Mobile Nav (max width 767px)-->
    <div class="mobile-nav">
        <!-- Navbar Brand -->
        <div class="amado-navbar-brand">
            <a href="{{url('/')}}"><img src="{{asset('assets/img/core-img/logo.png')}}" alt=""></a>
        </div>
        <!-- Navbar Toggler -->
        <div class="amado-navbar-toggler">
            <span></span><span></span><span></span>
        </div>
    </div>
    <!-- Header Area Start -->
    <header class="header-area clearfix">
        <!-- Close Icon -->
        <div class="nav-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <!-- Logo -->
        <div class="logo">
            <b style="font-size: 2em;">Nwafor</b><a href="{{url('/')}}"><img src="{{asset('assets/img/core-img/logo.png')}}" alt=""></a><b style="font-size: 2em;">Review</b>
        </div>
        <!-- Amado Nav -->
        <nav class="amado-nav">
            <ul>
                <li class="active"><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('create')}}">Add Item</a></li>
                @if(Auth::check())
                    <?php $hasFollowing = App\Models\Follower::where('follower_id', Auth::user()->id)->get(); ?>
                    @if($hasFollowing)
                        <li><a href="{{ url('followers') }}">Followings</a></li>
                    @endif
                @endif
                @if(!Auth::check())
                <li><a href="{{route('login')}}">Login</a></li>
                <li><a href="{{route('register')}}">Register</a></li>
                @endif
                <li><a href="{{url('docs')}}">Documentation</a></li>

                @if(Auth::check())
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                @endif
            </ul>
        </nav>
        
       
        <div class="social-info d-flex justify-content-between">
            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            
        </div>
    </header>
    <!-- Header Area End -->
    