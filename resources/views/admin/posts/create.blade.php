@extends('admin.app')

@section('title', 'Add Post')

@section('content')
<div class="card-body">
    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary ml-6">Back all posts</a>
</div>
<center>
<form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
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
                <h2>Create Post</h2> <br>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="title" placeholder="Enter title" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option disabled selected>Status of post </option>
                                <option value="1">Active</option>
                                <option value="0"> Not Active</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea name="description" style="height: 100px" placeholder="Enter description to this post" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="file" id="postImage" name="images[]" multiple  class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <select name="category_id" class="form-control">
                                <option  selected>select Category </option>
                                @foreach ($categories as $category )
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select name="comment_able" class="form-control">
                                <option  selected> Comment able </option>
                                <option value="1">Active</option>
                                <option value="0"> Not Active</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create Post</button>
            </div>
        </center>

    </form>

@endsection

@push('js')

<script>
    $(function() {

        $('#postImage').fileinput({
            theme: 'fa5',
            maxFileCount: 5,
            allowedFileTypes: ['image'],
            enableResumableUpload: false,
            showUpload: false,


        });
        // $('#postContent').summernote({
        //     height: 300,
        // });
    });

</script>


@endpush
