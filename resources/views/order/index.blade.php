@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row g-4">
            @foreach($users as $user)
                @foreach($user->orders as $order)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-start pt-1">Order Number {{ $order->id }}</div>
                                @if(auth()->user()->is_admin)
                                    <button class="float-end ms-3 btn btn-sm btn-danger">Delete</button>
                                @endif
                                <div class="float-end text-muted pt-1">{{ $order->created_at->format('d M Y') }}</div>
                            </div>
                            <div class="card-body">
                                @foreach($order->carts as $cart)
                                    <div class="row">
                                        <div class="col-4">{{ $cart->menu->title }}</div>
                                        <div class="col-4">x{{ $cart->quantity }}</div>
                                        <div class="col-4">Rs {{ $cart->subtotal }}</div>
                                    </div>
                                @endforeach
                                <hr>
                                <div class="row fw-bold">
                                    <div class="col-4">Total</div>
                                    <div class="col-4">x{{ $order->num_items }}</div>
                                    <div class="col-4">Rs {{ $order->total }}</div>
                                </div>
                            </div>
{{--                            @if(auth()->user()->is_admin)--}}
{{--                                <div class="card-footer">--}}
{{--                                    <button class="btn btn-sm btn-danger">Delete</button>--}}
{{--                                </div>--}}
{{--                            @endif--}}
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
