@extends('admin.app')

@section('title', 'Add User')

@section('content')
<div class="card-body">
    <a href="{{ route('admin.users.index') }}" class="btn btn-primary ml-6">Back to users</a>
</div>
<center>
<form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
    @csrf
            <div class="card-body col-10 shadow mt-4">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <h2>Create New User</h2> <br>
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
                            <input type="text" name="phone" placeholder="Enter phone" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="country" placeholder="Enter country" class="form-control">

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="city" placeholder="Enter city name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option disabled selected>Status </option>
                                <option value="1">Active</option>
                                <option value="0"> Not Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="street" placeholder="Enter street name" class="form-control">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <select name="email_verified_at" class="form-control">
                                <option disabled selected>email_verified_at </option>
                                <option value="1">Active</option>
                                <option value="0"> Not Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="file" name="image" placeholder="Enter image" class="form-control">
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
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </center>

    </form>

@endsection
