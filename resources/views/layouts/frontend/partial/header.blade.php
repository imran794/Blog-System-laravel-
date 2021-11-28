<header>
    <div class="container-fluid position-relative no-side-padding">

        <a href="{{ url('/') }}" class="logo">Blog</a>

        <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ route('all.post') }}">Posts</a></li>
            @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
            @else
            @if (Auth::user()->role->id == 1)
              <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @elseif(Auth::user()->role->id == 2)
               <li><a href="{{ route('author.dashboard') }}">Dashboard</a></li>
            @endif
            @endguest
                
            </ul>
        

        <div class="src-area">
            <form action="{{ route('post.search') }}" method="get">
                <input class="src-input" name="query" value="{{ isset($query) ? $query : '' }}"  type="text" placeholder="Search">
                <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                
            </form>
        </div>

    </div><!-- conatiner -->
</header>
