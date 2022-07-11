@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center w-100">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset($menu->path) }}" class="img-fluid square rounded-start" alt="{{ $menu->title }}">
                        </div>
                        <div class="col-md-8 align-self-center ps-5">
                            <div class="card-body h-100">
                                <h2 class="card-title pb-3">{{ $menu->title }}</h2>
                                <p class="card-text">{{ $menu->desc }}</p>
                                <p class="card-text"><small class="text-muted">Rs {{ $menu->price }}</small></p>
                            </div>
                            <div class="p-3">
                                <a href="{{ route('add.to.cart', $menu->id) }}" class="btn btn-primary">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
