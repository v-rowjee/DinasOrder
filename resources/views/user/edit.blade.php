@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-md-2 col-md-8">
                <div class="card">
                    <div class="card-header">Edit User ID {{ $user->id }}</div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                            </div>
                            <div class="col-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>
                            </div>
                            <div class="col-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" value="{{ $user->address }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-end">
                            <a href="{{ route('user.show', $user->id) }}" class="btn btn-secondary">Cancel</a>
                            <form action="{{ route('user.update', $user->id) }}" method="post" class="d-inline-block">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="btn btn-success">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
