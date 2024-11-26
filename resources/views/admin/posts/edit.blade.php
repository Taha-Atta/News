@extends('admin.app')

@section('title', 'Edit Post')

@section('content')
    <div class="card-body">
        <a href="{{ route('admin.posts.index') }}" class="btn btn-primary ml-6">Back all posts</a>
    </div>
    <center>
        <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                <h2>Update Post : {{ $post->title }}</h2> <br>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="title" value="{{ $post->title }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select name="status" class="form-control">
                            <option value="1" @selected($post->status == 1)>Active</option>
                                <option value="0"@selected($post->status == 0)> Not Active</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea name="description" style="height: 100px"  class="form-control">{{ $post->description }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="file" id="post_images" name="images[]" multiple class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <select name="category_id" class="form-control">
                                <option selected>select Category </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($category->id == $post->category_id)>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select name="comment_able" class="form-control">
                                <option value="1"@selected($post->comment_able == 1)> Active</option>
                                <option value="0"@selected($post->comment_able == 0)>Not Active</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Edit Post</button>
            </div>
        </form>
    </center>


@endsection



@push('js')
    <script>
        $('#post_images').fileinput({
            theme: 'fa5',
            maxFileCount: 5,
            allowedFileTypes: ['image'],
            enableResumableUpload: false,
            showUpload: false,
            initialPreviewAsData: true,
            initialPreview: [
                @if ($post->images()->count() > 0)
                    @foreach ($post->images as $image)
                        "{{ asset($image->path) }}",
                    @endforeach
                @endif
            ],
            initialPreviewConfig: [
                @if ($post->images()->count() > 0)
                    @foreach ($post->images as $image)
                        {
                            caption: "{{$image->path}}",
                            width: '120px',
                            url:"{{route('admin.delete.posts.image',[$image->id,'_token'=>csrf_token()])}}",
                            key: "{{$image->id}}",

                        },
                    @endforeach
                @endif
            ],
        });
    </script>
@endpush
