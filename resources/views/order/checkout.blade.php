@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('menu.index') }}">Menu</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Cart</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="d-flex justify-content-between align-items-center my-2">
                            <span class="text-capitalize">Your cart</span>
                            <span class="badge bg-secondary badge-pill">{{ count(session('cart')) }}</span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group mb-3">
                            @php $total=0 @endphp
                            @if(session('cart'))
                            @foreach(session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div class="flex-grow-1">
                                        <h6 class="my-0">{{ $details['title'] }}</h6>
                                        <span class="text-muted">x{{ $details['quantity'] }}</span>
                                    </div>
                                    <span class="text-muted flex-shrink-0">Rs {{ $details['price'] * $details['quantity'] }}</span>
                                </li>
                            @endforeach
                            @endif
                            <li class="list-group-item d-flex justify-content-between pt-4 pb-3 fw-bolder">
                                <h4>Total (MRU)</h4>
                                <h4>Rs {{ $total }}</h4>
                            </li>
                        </ul>
                        <a href="{{ route('order.success') }}" class="btn btn-primary w-100" type="submit">Place Your Order</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8 order-md-1">
                <div class="card">
                    <div class="card-header">
                        <h4 class="my-2">Info</h4>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate="">
                            <div class="row">
                                @php $names = explode(" ", auth()->user()->name)@endphp
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name</label>
                                    <input type="text" class="form-control" id="firstName" placeholder=""
                                           value="{{ array_shift($names) }}" required="">
                                    <div class="invalid-feedback"> Valid first name is required.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Last name</label>
                                    <input type="text" class="form-control" id="lastName" placeholder=""
                                           value="{{ array_pop($names) }}" required="">
                                    <div class="invalid-feedback"> Valid last name is required.</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="you@example.com" value="{{ auth()->user()->email }}">
                                <div class="invalid-feedback"> Please enter a valid email address</div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="" value="{{ auth()->user()->address }}">
                                <div class="invalid-feedback"> Please enter your address.</div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="my-4"></div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="my-2">Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback"> Name on card is required</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                                <div class="invalid-feedback"> Credit card number is required</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                                <div class="invalid-feedback"> Expiration date required</div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cc-cvv">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                                <div class="invalid-feedback"> Security code required</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
