{{--      Offcanvas Cart     --}}
<div class="offcanvas offcanvas-end" style="width:100%; max-width: 500px" tabindex="-1" id="cart">
    <div class="offcanvas-header">
        <h4 class="m-0">My Cart</h4>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-group d-flex align-middle mb-2">
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div class="d-flex">
                            <span class="me-5">
                                <img src="{{ asset($details['path']) }}" class="cart-img" alt="">
                            </span>
                            <span>
                                <p class="m-0">{{ $details['title'] }}</p>
                                <p class="text-muted m-0">Rs {{ $details['price'] * $details['quantity'] }}</p>
                            </span>
                        </div>
                        <div class="d-flex">
                            <span class="me-3">
                                <div class="d-flex" data-id="{{ $id }}">
                                    <button class="btn btn-link px-2 me-1 decrement-cart">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                    <input min="0" max="99" name="quantity" value="{{ $details['quantity'] }}"
                                           type="number"
                                           class="form-control form-control-sm quantity update-cart"/>

                                    <button class="btn btn-link px-2 ms-1 increment-cart">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </span>
                            <span>
                                <button data-id="{{ $id }}" class="btn btn-danger btn-sm remove-from-cart mt-1"><i class="fa fa-trash"></i></button>
                            </span>
                        </div>
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
        <a href="{{ route('cart.index') }}" class="btn btn-primary flex-grow-1 @if($total == 0) disabled @endif">View
            Cart</a>
    </div>
</div>
