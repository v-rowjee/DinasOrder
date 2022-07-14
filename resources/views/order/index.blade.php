@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($users as $user)
                @foreach($user->orders as $order)
                    <div class="offset-md-2 col-md-8 mb-3">
                        <div class="card">
                            <div class="card-header">Order {{ $order->id }}</div>
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
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
