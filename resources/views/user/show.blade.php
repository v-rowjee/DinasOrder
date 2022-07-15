@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-md-2 col-md-8">
                <div class="card">
                    <div class="card-header d-flex">
                        <b class="me-auto">User ID {{ $user->id }}</b>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary me-2">Edit</a>
                        <form action="{{ route('user.destroy', $user->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td><b>Name:</b> {{ $user->name }}</td>
                                <td><b>Role: </b> {{ $user->is_admin ? 'Admin' : 'User' }}</td>
                            </tr>
                            <tr>
                                <td><b>Email:</b> {{ $user->email }}</td>
                                <td><b>Email Verified At:</b> {{ $user->email_verified_at->format('d M Y @H:i') }}</td>
                            </tr>
                            <tr>
                                <td><b>Phone:</b> {{ $user->phone }}</td>
                                <td><b>Created At: </b> {{ $user->created_at->format('d M Y @H:i') }}</td>
                            </tr>
                            <tr>
                                <td><b>Address:</b> {{ $user->address }}</td>
                                <td><b>Updated At: </b> {{ $user->updated_at->format('d M Y @H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
