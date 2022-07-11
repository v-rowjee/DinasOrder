@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row g-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="d-flex justify-content-between align-items-center my-2">
                            <span class="text-capitalize">Your cart</span>
                            <span class="badge bg-secondary badge-pill me-1">{{ count(session('cart')) }}</span>
                        </h4>
                    </div>
                    <div class="card-body">
                        @if(session('cart'))
                            @foreach(session('cart') as $id => $details)
                                <div class="row mb-4 d-flex justify-content-between align-items-center">
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                        <img src="{{ asset($details['path']) }}" alt="{{ $details['title'] }}" class="img-fluid rounded-3 square">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <h6 class="text-black mb-0">{{ $details['title'] }}</h6>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex" data-id="{{ $id }}">
                                        <button class="btn btn-link px-2 me-1"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input min="0" max="99" name="quantity" value="{{ $details['quantity'] }}" type="number"
                                               class="form-control form-control-sm quantity update-cart"/>

                                        <button class="btn btn-link px-2 ms-1 increment-cart">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                        <h6 class="mb-0">Rs {{ $details['price'] * $details['quantity'] }}</h6>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end me-2">
                                        <button data-id="{{ $id }}" class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        @endif
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('home') }}" class="link-dark">
                            <span><i class="fa fa-arrow-left"></i></span>
                            <span>Back to Menu</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card sticky-md-top" style="top: 5rem">
                    <div class="card-header">
                        <h4 class="my-2">
                            <span class="text-capitalize">Summary</span>
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="d-flex justify-content-between align-items-center my-2">
                            <span>Number of Items</span>
                            <span>{{ count(session('cart')) }}</span>
                        </h5>
                        <hr class="my-4">
                        <h5 class="d-flex justify-content-between align-items-center my-2">
                            <span class="text-capitalize">Total(MRU)</span>
                            @php $total=0 @endphp
                            @foreach((array) session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                            @endforeach
                            <span class="fw-bold">Rs {{ $total }}</span>
                        </h5>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('checkout') }}" class="btn btn-primary w-100">Continue To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
