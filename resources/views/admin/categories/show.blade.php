@extends('admin.app')

@section('title', 'show User')

@section('content')
    <div class="card-body">
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary ml-6">Back to users</a>
    </div>

    <center>
    <div class="card-body col-10 shadow">
        <div class="row">
            <div class="col-6">
                <h2>show user : {{ $user->name }}</h2> <br>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <img src="{{ asset($user->image) }}" alt="user image"  class="rounded-circle" style="width:100px;hieght:100px">
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="Name :{{ $user->name }}" class="form-control">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input disabled value=" Username :{{ $user->username }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="Email : {{ $user->email }}" class="form-control">

                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="phone :{{ $user->phone }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="country :{{ $user->country }}" class="form-control">

                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="city :{{ $user->city }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input disabled value=" Status : {{ $user->status == 1 ? 'Active' : 'Not Active' }}"
                        class="form-control">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="street : {{ $user->street }}" class="form-control">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input disabled
                        value=" email_verified_at : {{ $user->email_verified_at == null ? 'Not Active' : 'Active' }}"
                        class="form-control">

                </div>
            </div>

        </div>

            <a href="{{ route('admin.change.status', $user->id) }}"
                class="btn btn-{{ $user->status == 0 ? 'warning' : 'dark' }}">
                {{ $user->status == 0 ? 'Active' : 'Block' }}
            </a>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Do you want to delete this user?');">Delete</button>
            </form>
        </div>
    </center>


@endsection
