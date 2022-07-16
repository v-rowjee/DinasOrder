@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-md-2 col-md-8">
                <a href="{{ route('user.index') }}" class="link text-secondary"><i class="fa fa-arrow-left"></i>Back</a>
                <div class="card mt-3">
                    <form action="{{ route('user.store') }}" method="post" class="d-inline-block">
                        @method('POST')
                        @csrf
                        <div class="card-header">Create New User</div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input id="confirm_password" type="text" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" value="{{ old('confirm_password') }}">
                                    @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="is_admin" class="form-label">Role</label>
                                    <select id="is_admin" name="is_admin" class="form-select">
                                        <option value="0">User</option>
                                        <option value="1">Admin</option>
                                    </select>
                                    @error('is_admin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <a href="{{ route('user.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
