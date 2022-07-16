<nav class="navbar navbar-expand-md navbar-light bg-white sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ URL::asset('images/logo.png') }}" alt="logo" height="35px">
        </a>
        <div class="d-flex">
            <a href="" class="nav-link text-reset cart-icon-left me-3" data-bs-toggle="offcanvas" data-bs-target="#cart">
                <i class="fa fa-shopping-cart"></i>
                <span class="badge rounded-pill bg-danger position-absolute">{{ count((array) session('cart')) }}</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse ms-4" id="navbarSupportedContent">
            <!-- Middle Side Of Navbar -->
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : ''}}" href="{{ route('home.index') }}">{{ __('Home') }}</a>
                </li>
                @if( Auth::check() && Auth::user()->is_admin)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('user') ? 'active' : ''}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Users
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('user.index') }}">View Users</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.create') }}">Create User</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('menu') ? 'active' : ''}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('menu.index') }}">View Menu</a></li>
                            <li><a class="dropdown-item" href="{{ route('menu.create') }}">Create Menu</a></li>
                        </ul>
                    </li>
                @else
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('menu') ? 'active' : ''}}" href="{{ route('menu.index') }}">{{ __('Menu') }}</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('order') ? 'active' : ''}}" href="{{ route('order.index') }}">{{ __('Order') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('cart') ? 'active' : ''}} @if(empty (Session::get('cart'))) disabled @endif" href="{{ route('cart.index') }}">{{ __('Cart') }}</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </li>
                @endguest
                <li class="nav-item">
                    <a href="" class="nav-link text-reset cart-icon-right" data-bs-toggle="offcanvas" data-bs-target="#cart">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="badge rounded-pill bg-danger position-absolute">{{ count((array) session('cart')) }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
