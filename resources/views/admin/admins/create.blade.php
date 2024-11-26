@extends('admin.app')

@section('title', 'Add Admin')

@section('content')
    <div class="card-body">
        <a href="{{ route('admin.admins.index') }}" class="btn btn-primary ml-6">Back to admins</a>
    </div>
    <center>
        <form action="{{ route('admin.admins.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body col-10 shadow mt-4">
                <h2>Create New Admin</h2> <br>
                @include('error')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Enter name" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="username" placeholder="Enter username" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Enter user email" class="form-control">

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option disabled selected>Status </option>
                                <option value="1">Active</option>
                                <option value="0"> Not Active</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-12">
                        <div class="form-group">
                            Roles: <select name="role_id" class="form-control">
                                <option disabled selected>select role</option>
                                @forelse ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role }}</option>

                                @empty
                                    <option>No Role</option>
                                @endforelse
                            </select>
                            @error('role_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Enter password" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="password" name="password_confirmation" placeholder="Enter password again"
                                class="form-control">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create Admin</button>
            </div>
    </center>

    </form>


@endsection
