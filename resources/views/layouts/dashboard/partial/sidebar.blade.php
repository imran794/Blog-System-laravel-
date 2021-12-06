 <aside id="leftsidebar" class="sidebar">
     <!-- User Info -->
     <div class="user-info">
         <div class="image">
             <img src="{{ Storage::disk('public')->url('profile/'.Auth::user()->image) }}" width="48" height="48" alt="User" />
         </div>
         <div class="info-container">
             <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
             <div class="email">{{ Auth::user()->email }}</div>
             <div class="btn-group user-helper-dropdown">
                 <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                 <ul class="dropdown-menu pull-right">
                     <li><a href="{{ Auth::user()->role->id == 1 ? route('admin.setting') : route('author.setting') }}"><i class="material-icons">settings</i>Setting</a></li>

                     <li>
                         <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                             <i class="material-icons">input</i> Log Out
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                         </form>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
     <!-- #User Info -->
     <!-- Menu -->
     <div class="menu">
         <ul class="list">
             <li class="header">MAIN NAVIGATION</li>

             @if (Request::is('admin*'))
             <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                 <a href="{{ url('admin/dashboard') }}">
                     <i class="material-icons">dashboard</i>
                     <span>Dashboard</span>
                 </a>
             </li>
             <li class="{{ Request::is('admin/tag*') ? 'active' : '' }}">
                 <a href="{{ route('admin.tag.index') }}">
                     <i class="material-icons">label</i>
                     <span>Tag</span>
                 </a>
             </li>
             <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                 <a href="{{ route('admin.category.index') }}">
                     <i class="material-icons">apps</i>
                     <span>Category</span>
                 </a>
             </li>
             <li class="{{ Request::is('admin/post*') ? 'active' : '' }}">
                 <a href="{{ route('admin.post.index') }}">
                     <i class="material-icons">library_books</i>
                     <span>Post</span>
                 </a>
             </li>
             <li class="{{ Request::is('admin/pending/post') ? 'active' : '' }}">
                 <a href="{{ route('admin.post.pending') }}">
                     <i class="material-icons">library_books</i>
                     <span>Pending Post</span>
                 </a>
             </li>
              <li class="{{ Request::is('admin/favorite/post/show') ? 'active' : '' }}">
                 <a href="{{ route('admin.favorite.post.show') }}">
                     <i class="material-icons">favorite</i>
                     <span>Favorite Post</span>
                 </a>
             </li>
              <li class="{{ Request::is('admin/comment/show') ? 'active' : '' }}">
                 <a href="{{ route('admin.comment.show') }}">
                     <i class="material-icons">comment</i>
                     <span>Comment</span>
                 </a>
             </li>
              <li class="{{ Request::is('admin/subcribe') ? 'active' : '' }}">
                 <a href="{{ route('admin.subcribe.index') }}">
                     <i class="material-icons">subscriptions</i>
                     <span>Subcribe</span>
                 </a>
             </li> 
                <li class="{{ Request::is('admin/all/author') ? 'active' : '' }}">
                 <a href="{{ route('admin.all.author') }}">
                     <i class="material-icons">account_circle</i>
                     <span>All Author</span>
                 </a>
             </li> 
             <li class="header">System</li>
              
               <li class="{{ Request::is('admin/setting') ? 'active' : '' }}">
                 <a href="{{ route('admin.setting') }}">
                     <i class="material-icons">settings</i>
                     <span>Setting</span>
                 </a>
             </li>
             <li>
                 <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                     <i class="material-icons">input</i>
                     <span> Log Out </span>
                 </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
             </li>


             @endif

             @if (Request::is('author*'))
             <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                  <a href="{{ url('author/dashboard') }}">
                     <i class="material-icons">dashboard</i>
                     <span>Dashboard</span>
                 </a>
             </li>
             <li class="{{ Request::is('author/post*') ? 'active' : '' }}">
                 <a href="{{ route('author.post.index') }}">
                     <i class="material-icons">library_books</i>
                     <span>Posts</span>
                 </a>
             </li>
              <li class="{{ Request::is('author/comment/show') ? 'active' : '' }}">
                 <a href="{{ route('author.comment.show') }}">
                     <i class="material-icons">comment</i>
                     <span>Comment</span>
                 </a>
             </li>
             <li class="header">System</li>
                <li class="{{ Request::is('author/setting') ? 'active' : '' }}">
                 <a href="{{ route('author.setting') }}">
                     <i class="material-icons">settings</i>
                     <span>Setting</span>
                 </a>
             </li>
                  <li class="{{ Request::is('author/favorite/post/show') ? 'active' : '' }}">
                 <a href="{{ route('author.favorite.post.show') }}">
                     <i class="material-icons">favorite</i>
                     <span>Favorite Post</span>
                 </a>
             </li>
             <li>
                 <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                     <i class="material-icons">input</i>
                     <span> Log Out </span>
                 </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
             </li>
             @endif



         </ul>
     </div>
     <!-- #Menu -->
     <!-- Footer -->
     <div class="legal">
         <div class="copyright">
             &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
         </div>
         <div class="version">
             <b>Version: </b> 1.0.5
         </div>
     </div>
     <!-- #Footer -->
 </aside>
