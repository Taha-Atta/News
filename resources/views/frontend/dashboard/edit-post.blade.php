@extends('layouts.frontend.app')

@section('title')
    Edit Post {{ $post->title }}
@endsection

@section('body')
    <div class="dashboard container">

        @include('frontend.dashboard._sidebar' )

        <!-- Main Content -->
        <div class="main-content col-md-9">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <!-- Show/Edit Post Section -->
            <form action="{{ route('frontend.dashboard.update.post', $post->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                <section id="posts-section" class="posts-section">
                    <h2>Your Post</h2>
                    <ul class="list-unstyled user-posts">
                        <!-- Example of a Post Item -->
                        <li class="post-item">
                            <!-- Editable Title -->
                            <input type="text" name="title" class="form-control mb-2 post-title"
                                value="{{ $post->title }}" />

                            <!-- Editable Content -->
                            <textarea name="description" style="height: 200px" class="form-control mb-2  post-content">
                    {{ $post->description }}
                     </textarea>




                            <!-- Image Upload Input for Editing -->
                            <input id="post_images" type="file" name="images[]" class="form-control mt-2 edit-post-image"
                                accept="image/*" multiple />

                            <!-- Editable Category Dropdown -->
                            <select name="category_id" class="form-control mb-2 post-category">

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($category->id == $post->category_id)>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Editable Enable Comments Checkbox -->
                            <div class="form-check mb-2">
                                <input class="form-check-input enable-comments" name="comment_able"
                                    @checked($post->comment_able == 1) type="checkbox" />
                                <label class="form-check-label">
                                    Enable Comments
                                </label>
                            </div>

                            <!-- Post Meta: Views and Comments -->
                            <div class="post-meta d-flex justify-content-between">
                                <span class="views">
                                    <i class="fas fa-eye"></i> {{ $post->num_of_views }}</span>
                                <span class="post-comments">
                                    <i class="fas fa-comment"></i> {{ $post->comments()->count() }}</span>
                            </div>

                            <!-- Post Actions -->
                            <div class="post-actions mt-2">

                                <button type="submit" class="btn btn-success save-post-btn ">
                                    Save
                                </button>
                                <a href="{{ route('frontend.dashboard.profile') }}"
                                    class="btn btn-secondary cancel-edit-btn ">
                                    Cancel
                                </a>
                            </div>

                        </li>
                        <!-- Additional posts will be added dynamically -->
                    </ul>
                </section>
            </form>
        </div>
    </div>
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
                            url:"{{route('frontend.dashboard.delete.post.image',[$image->id,'_token'=>csrf_token()])}}",
                            key: "{{$image->id}}",

                        },
                    @endforeach
                @endif
            ],
        });
    </script>
@endpush
