<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    {{--  jQuery  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
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
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : ''}}" href="{{ route('home.index') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('menu') ? 'active' : ''}}" href="{{ route('menu.index') }}">{{ __('Menu') }}</a>
                        </li>
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
                        @if( Auth::check() && Auth::user()->is_admin)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Admin
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('menu.create') }}">Create Menu</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.index') }}"></a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                        @endif
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

        @include('layouts.offcanvas')

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script type="text/javascript">

        $(".update-cart").change(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: $(this).parent("div").attr("data-id"),
                    quantity: $(this).val()
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });

        $(".increment-cart").click(function (e) {
            e.preventDefault();
            const qty = parseInt($(this).siblings("input").val()) + 1;

            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: $(this).parent("div").attr("data-id"),
                    quantity: qty
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });

        $(".decrement-cart").click(function (e) {
            e.preventDefault();
            const qty = parseInt($(this).siblings("input").val()) -1;

            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: $(this).parent("div").attr("data-id"),
                    quantity: qty
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });



        $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('cart.destroy') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: $(this).attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });

    </script>
</body>
</html>
