@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 order-lg-1">
            @foreach($categories as $category)
                <div class="row g-4 mb-5" id="{{ $category->category }}">
                    <h2 class="text-capitalize">{{ $category->category }}</h2>
                    @foreach($menus as $menu)
                        @if($menu->category == $category->category)
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="card">
                                    <img src="{{ asset($menu->path) }}" class="card-img-top square" alt="{{$menu->title}}">
                                    <a href="{{ route('add.to.cart', $menu->id) }}" class="add-to-cart btn btn-sm btn-light"><i class="fa-solid fa-cart-plus"></i></a>
                                    <div class="card-body p-3">
                                        <h5 class="card-title text-capitalize">{{$menu->title}}</h5>
                                        <h6 class="card-text text-secondary h-2rem overflow-hidden">{{$menu->desc}}</h6>
                                        <a href=" {{ route('menus.show', $menu->id) }}" class="opacity-0 stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

