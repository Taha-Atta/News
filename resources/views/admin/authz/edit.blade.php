@extends('admin.app')

@section('title', 'Edit Role')

@section('content')
    <div class="card-body">
        <a href="{{ route('admin.authz.index') }}" style="margin-left: 50px" class="btn btn-primary ">Back to Roles</a>
    </div>
    <div class="d-flex justify-content-center w-100">
        <form action="{{ route('admin.authz.update',$authz->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body col-10 mx-auto shadow" style="min-width: 90ch;">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2>Edit Role</h2> <br>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" name="role" value="{{$authz->role}}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach (config('authz.permissions') as $key => $value)
                    <div class="col-3 mb-3">
                            <span style="margin-right: 15px;">
                                {{ $value }}:
                                <input type="checkbox" name="permissions[]" value="{{ $key }}"
                                       @if(in_array($key, $authz->permissions)) checked @endif>
                            </span>
                        </div>
                        @endforeach
                </div>
                <br>
                <button type="submit" class="btn btn-info">Edit Role</button>
            </div>
        </form>
    </div>


@endsection
