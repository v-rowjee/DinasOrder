@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex">
            <div class="me-auto">
                <a href="{{ route('user.create') }}" class="btn btn-primary mb-4">Create New User</a>
            </div>
            <div>{!! $users->links() !!}</div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Type</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="align-middle">
                        <th scope="row">{{ $user->id }}</th>
                        <td>
                            @if($user->is_admin)
                                <span class="badge bg-dark">Admin</span>
                            @else
                                <span class="badge bg-secondary">Normal</span>
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary me-2">Edit</a>
                                <a href="{{ route('user.show', $user->id) }}" class="btn btn-sm btn-success me-2">View</a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
