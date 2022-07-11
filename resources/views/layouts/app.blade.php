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
                    <a href="" class="nav-link text-reset cart-icon-left" data-bs-toggle="offcanvas" data-bs-target="#cart">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="badge rounded-pill bg-danger position-absolute">{{ count((array) session('cart')) }}</span>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('All') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#starter">{{ __('Starter') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#pasta">{{ __('Pasta') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#pizza">{{ __('Pizza') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#dessert">{{ __('Dessert') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#drinks">{{ __('Drinks') }}</a>
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

        {{--      Offcanvas Cart     --}}
        <div class="offcanvas offcanvas-end" style="width:100%; max-width: 500px" tabindex="-1" id="cart">
            <div class="offcanvas-header">
                <h4 class="m-0">My Cart</h4>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="list-group d-flex align-middle">
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                                <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                    <span>
                                        <img src="{{ asset($details['path']) }}" class="cart-img" alt="">
                                    </span>
                                            <span>
                                        <p class="m-0">{{ $details['title'] }}</p>
                                        <p class="text-muted m-0">Rs {{ $details['price'] * $details['quantity'] }}</p>
                                    </span>
                                    <span>
                                        <div class="d-flex" data-id="{{ $id }}">
                                            <button class="btn btn-link px-2 me-1"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <input min="0" max="99" name="quantity" value="{{ $details['quantity'] }}" type="number"
                                                   class="form-control form-control-sm quantity update-cart"/>

                                            <button class="btn btn-link px-2 ms-1 increment-cart"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </span>
                                    <span>
                                        <button data-id="{{ $id }}" class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash"></i></button>
                                    </span>
                                </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="offcanvas-footer m-3 d-flex justify-content-between">
                @php $total = 0 @endphp
                @foreach((array) session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                @endforeach
                <div class="btn btn-outline-primary me-3 flex-shrink-0">Total Rs {{ $total }}</div>
                <a href="{{ route('cart') }}" class="btn btn-primary flex-grow-1">View Cart</a>
            </div>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script type="text/javascript">

        $(".update-cart").change(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('update.cart') }}',
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
            const qty = parseInt($(this).siblings("input").val()) +1;

            $.ajax({
                url: '{{ route('update.cart') }}',
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
                url: '{{ route('remove.from.cart') }}',
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
