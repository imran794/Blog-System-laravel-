<header>
    <div class="container-fluid position-relative no-side-padding">

        <a href="{{ url('/') }}" class="logo">Blog</a>

        <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="">Posts</a></li>
          
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
        
        {{-- 
                    <li><a href="">Dashboard</a></li>


                    <li><a href="">Dashboard</a></li> --}}
        </ul><!-- main-menu -->

        <div class="src-area">
                <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                <input class="src-input" value="" name="query" type="text" placeholder="Search">
        </div>

    </div><!-- conatiner -->
</header>
