@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center w-100">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">
                        <h3>Thank you for your order!</h3>
                    </div>
                    <div class="card-body">
                        <p>Please check your email for further information.</p>
                        <span>Any queries? </span><a href="">Contact us</a>
                        <br><div class="my-5"></div>
                        <a href="{{ route('home') }}" class="btn btn-primary">Continue to Homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
