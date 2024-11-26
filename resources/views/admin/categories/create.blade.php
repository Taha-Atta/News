@extends('admin.app')

@section('title', 'Add Category')

@section('content')
    <div class="card-body">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary ml-6">Back to categories</a>
    </div>
    <center>
        <form action="{{ route('admin.categories.store') }}" method="post">
            @csrf
            <div class="card-body col-10 shadow mt-4">
                <h2>Create New Category</h2> <br>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Enter name of category" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </div>

        </form>
    </center>

@endsection
