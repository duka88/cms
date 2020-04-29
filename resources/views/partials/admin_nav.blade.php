   <nav id="sidebar" class="col-3">
      
        <ul class="list-group components">          
            <li class="list-group-item">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle w-100">Posts</a>
                <ul class="collapse list-unstyled 
                  @if(in_array( Request::path(), array('posts','trashed-posts', 'categories', 'tags'))) 
                   show
                  @endif
                " id="homeSubmenu">
                    <li class=" {{Request::is('posts') ? 'active' : ''}} ">
                      <a href="{{route('posts.index')}}">All Posts</a>
                    </li>
                   <li class="{{Request::is('trashed-posts') ? 'active' : ''}} ">
                      <a href="{{route('posts.trashed')}}">Trashed Posts</a>
                    </li>
                    <li class="{{Request::is('categories') ? 'active' : ''}} ">
                      <a href="{{route('categories.index')}}">Categories</a>
                   </li>
                   <li class="{{Request::is('tags') ? 'active' : ''}} ">
                      <a href="{{route('tags.index')}}">Tags</a>
                   </li>
                </ul>
            </li>         
            <li class="list-group-item">
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Clients</a>
                <ul class="collapse list-unstyled
                  @if(in_array( Request::path(), array('clients', 'services'))) 
                     show
                    @endif
                " id="pageSubmenu">
                    <li class=" {{Request::is('clients') ? 'active' : ''}} ">
                        <a href="{{route('clients.index')}}">All Clients</a>
                     </li>
                     <li class=" {{Request::is('services') ? 'active' : ''}} ">
                        <a href="{{route('services.index')}}">Services</a>
                     </li>
                </ul>
            </li>
            <li class="list-group-item {{Request::is('users') ? 'active' : ''}}">
                <a href="{{route('users.index')}}">Users</a>
            </li>
            <li class="list-group-item ">
               <a href="{{ route('logout') }}"

                              onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                              
                               {{ __('Logout') }}
                           </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                </form>
            </li>     
        </ul>
    </nav>

