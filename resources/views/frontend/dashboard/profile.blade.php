@extends('layouts.frontend.app')

@section('title', 'Profile')

@section('body')
    <!-- Profile Start -->
@section('breadcrumb')

@endsection
<div class="dashboard container">
    <!-- Sidebar -->
    @include('frontend.dashboard._sidebar',['profile_active'=>'active'] )

    <!-- Main Content -->
    <div class="main-content">
        <!-- Profile Section -->
        <section id="profile" class="content-section active">
            <h2>User Profile</h2>
            <div class="user-profile mb-3">
                <img src="{{ asset(Auth::user()->image) }}" alt="User Image" class="profile-img rounded-circle"
                    style="width: 100px; height: 100px;" />
                <span class="username"> {{ Auth::user()->name }}</span>
            </div>
            <br>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Add Post Section -->
            <form action="{{ route('frontend.dashboard.add.post') }}" method="post" enctype="multipart/form-data">
                @csrf
                <section id="add-post" class="add-post-section mb-5">
                    <h2>Add Post</h2>
                    <div class="post-form p-3 border rounded">
                        <!-- Post Title -->
                        <input type="text" id="postTitle" name="title" class="form-control mb-2"
                            placeholder="Post Title" />

                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" />

                        <!-- Post Content -->
                        <textarea id="postContent" name="description" class="form-control mb-2" rows="3"
                            placeholder="What's on your mind?"></textarea>

                        <!-- Image Upload -->
                        <input type="file" id="postImage" name="images[]" class="form-control mb-2" accept="image/*"
                            multiple />
                        <div class="tn-slider mb-2">
                            <div id="imagePreview" class="slick-slider"></div>
                        </div>

                        <!-- Category Dropdown -->
                        <select id="postCategory" name="category_id" class="form-control">
                            <option value="" selected>select cayegory</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select> <br>

                        <!-- Enable Comments Checkbox -->
                        <label class="form-check-label mb-2">
                            Enable Comments : <input name="comment_able" type="checkbox" />
                        </label><br>

                        <!-- Post Button -->
                        <button type="submit" class="btn btn-primary post-btn">Post</button>
                    </div>
                </section>
            </form>

            <!-- Posts Section -->
            <section id="posts" class="posts-section">
                <h2>Recent Posts</h2>
                <div class="post-list">
                    <!-- Post Item -->
                    @foreach ($posts as $post)
                        <div class="post-item mb-4 p-3 border rounded">
                            <div class="post-header d-flex align-items-center mb-2">
                                <img src="{{ asset(auth()->user()->image) }}" alt="User Image" class="rounded-circle"
                                    style="width: 50px; height: 50px;" />
                                <div class="ms-4">
                                    <h5 class="mb-0">{{ auth()->user()->name }}</h5>

                                </div>
                            </div>
                            <h4 class="post-title">{{ $post->title }}</h4>
                           <p class="post-page"> {{ chunk_split($post->description, 40) }}</p>


                            <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#newsCarousel" data-slide-to="1"></li>
                                    <li data-target="#newsCarousel" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($post->images as $index => $image)
                                        <div class="carousel-item @if ($index == 0) active @endif">
                                            <img src="{{ asset($image->path) }}" class="d-block w-100"
                                                alt="First Slide">
                                            {{-- <div class="carousel-caption d-none d-md-block">
                                        <h5>dsfdk</h5>
                                        <p>
                                            oookok
                                        </p>
                                    </div> --}}
                                        </div>
                                    @endforeach



                                    <!-- Add more carousel-item blocks for additional slides -->
                                </div>
                                <a class="carousel-control-prev" href="#newsCarousel" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#newsCarousel" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                            <div class="post-actions d-flex justify-content-between">
                                <div class="post-stats">
                                    <!-- View Count -->
                                    <span class="me-3">
                                        <i class="fas fa-eye"></i> {{ $post->num_of_views }}
                                    </span>
                                </div>

                                <div>
                                    <a href="{{ route('frontend.dashboard.edit.post', $post->slug) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="javascript:void(0)"
                                        onclick="if(confirm('Are you sure to Delete this post ?')){getElementById('deletePost_{{ $post->id }}').submit()} return false"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-thumbs-up"></i> Delete </a>

                                    <button id="getcomment_{{$post->id}}" class="getcomment" post-id="{{ $post->id }}"
                                        class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-comment"></i> Comments </button>

                                    <button id="hidecomment_{{$post->id}}" class="hidecomment" post-id="{{ $post->id }}"
                                        class="btn btn-sm btn-outline-secondary" style="display: none">
                                        <i class="fas fa-comment"></i> Hide Comments </button>



                                    <form action="{{ route('frontend.dashboard.delete.post', $post->slug) }}"
                                        id="deletePost_{{ $post->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>

                            <!-- Display Comments -->
                            <div class="comments" id="displayComment_{{ $post->id }}" style="display: none">


                                <!-- Add more comments here for demonstration -->
                            </div>
                        </div>
                    @endforeach


                    <!-- Add more posts here dynamically -->
                </div>
            </section>
        </section>
    </div>
</div>
<!-- Profile End -->
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

    $(document).on('click', '.getcomment', function(e) {
        e.preventDefault();
        var post_id = $(this).attr('post-id')

        $.ajax({
            url: '{{ route('frontend.dashboard.comment.post', ':post_id') }}'.replace(':post_id',post_id),
            type: 'GET',
            success: function(response) {
                $('#displayComment_' + post_id).empty();
                $.each(response.data, function(indexarray, comment){
                    $('#displayComment_' + post_id).append(`<div class="comment">
                                    <img src="${comment.user.image }" alt="User Image" class="comment-img" />
                                    <div class="comment-content">
                                        <span class="username">${comment.user.name}</span>
                                        <p class="comment-text">${comment.comment}</p>
                                    </div>
                                     </div>`).show();
                });
                $('#getcomment_' + post_id).hide();
                $('#hidecomment_' + post_id).show();

            }

        });
    });

    $(document).on('click','.hidecomment',function(e){
        e.preventDefault();
        var post_id = $(this).attr('post-id')

        // 1- hide btn hidecommment
        $('#hidecomment_' + post_id).hide();

        // 2- hide div commment
        $('#displayComment_'+ post_id).hide();
        // 3- show btn commment
        $('#getcomment_' + post_id).show();

    });
</script>
@endpush
