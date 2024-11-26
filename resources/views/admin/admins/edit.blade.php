@extends('admin.app')

@section('title', 'Edit Admin')

@section('content')
    <div class="card-body">
        <a href="{{ route('admin.admins.index') }}" class="btn btn-primary ml-6">Back to admins</a>
    </div>
    <div class="d-flex justify-content-center ">
        <form action="{{ route('admin.admins.update', $admin->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body  shadow " style="min-width: 80ch">
                @include('error')
                <h2>Edit Admin</h2> <br>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            Name: <input type="text" name="name" value="{{ $admin->name }}" class="form-control">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            UserName: <input type="text" name="username" value="{{ $admin->username }}"
                                class="form-control">
                                @error('username')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            Email: <input type="email" name="email" value="{{ $admin->email }}" class="form-control">
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            Status: <select name="status" class="form-control">
                                <option value="1" @selected($admin->status == 1)>Active</option>
                                <option value="0"@selected($admin->status == 0)> Not Active</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            Roles: <select name="role_id" class="form-control">
                                @forelse ($roles as $role)
                                    <option value="{{ $role->id }}" @selected($admin->role_id == $role->id)>{{ $role->role }}</option>

                                @empty
                                    <option>No Role</option>
                                @endforelse
                            </select>
                            @error('role_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                           Password : <input type="password" name="password" placeholder="Enter password" class="form-control">
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            password confirmation : <input type="password" name="password_confirmation" placeholder="Enter password again"
                                class="form-control">
                                @error('password_confirmation')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Admin</button>
            </div>


        </form>
    </div>

@endsection
