<header class="p-2 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 me-2 text-dark text-decoration-none">
                <img style="width:50px; height:45px; object-fit:scale-down; padding:0; margin:0" src="{{ Vite::asset('resources/images/logo.png') }}"><strong>PRG 5</strong>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{url('posts')}}" class="nav-link px-2 link-secondary">Overview</a></li>
                <li><a href="{{url('about')}}" class="nav-link px-2 link-dark">About</a></li>
            </ul>

            @guest
                <div class="col-md-3 text-end">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary me-2">Sign-up</a>
                </div>
            @endguest

            @auth()
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <x-profile style="height:35px" :picture="auth()->user()->mc_uuid"/>
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item"  @if(Request::is('profile*')) style="text-decoration:underline" @endif href="{{route('users.show', auth()->user())}}">Profile</a></li>
                        @admin

                        <li><a class="dropdown-item"  @if(Request::is('admin*')) style="text-decoration:underline" @endif href="{{route('categories.index')}}">Admin</a></li>
                        @endadmin
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form id="logout-form" class="pb-0 mb-0" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" form="logout-form" class="dropdown-item pb-0 mb-0" value="Submit">
                                    Log out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
        </div>
        @endauth
    </div>
</header>
