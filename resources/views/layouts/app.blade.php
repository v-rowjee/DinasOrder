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

        @include('layouts.navbar')

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
