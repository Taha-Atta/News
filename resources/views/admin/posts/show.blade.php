@extends('admin.app')

@section('title', 'show posy')

@section('content')
 {{-- @dd(request()); --}}
<div class="card-body">
    <a href="{{ route('admin.posts.index',['page'=>request()->page]) }}" class=" btn btn-primary"> Back to all Post</a>
</div>

    <div class="d-flex justify-content-center">
        <div class="col-8">
            <!-- Carousel -->
            <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#newsCarousel" data-slide-to="1"></li>
                    <li data-target="#newsCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach ($mainPost->images as $key => $image)
                        <div class="carousel-item @if ($key == 0) active @endif">

                            <img style="width:300px;height:450px" src="{{ asset($image->path) }}" class="d-block w-100"
                                alt="First Slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{!! $mainPost->title !!}</h5>
                                <p>
                                    {{-- {{ Str::limit($mainPost->description, 80) }} --}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                    <!-- Add more carousel-item blocks for additional slides -->
                </div>
                <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="sn-content">

                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <p><i class="fa fa-user"></i> {{ $mainPost->user->name ?? $mainPost->admin->name }}</p>
                        </div>
                        <div class="col-4">
                            <p>{{ $mainPost->num_of_views }} <i class="fa fa-eye"></i></p>
                        </div>
                        <div class="col-4">
                            <p>Posted: {{ $mainPost->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p> Comment able: {{ $mainPost->comment_able == 1 ? 'Active' : 'NotActive' }}</p>
                        </div>
                        <div class="col-4">
                            <p> Status: {{ $mainPost->status == 1 ? 'Active' : 'NotActive' }}</p>
                        </div>
                        <div class="col-4">
                            <p>Category: {{ $mainPost->category->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sn-content">
                {{ $mainPost->description }}
            </div>
            <div class="sn-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">

                            <center>
                                @if ($mainPost->user_id == null)
                                    <a href="{{ route('admin.posts.edit', $mainPost->id) }}" class="btn btn-primary">Edit</a>
                                @endif
                                <a href="{{ route('admin.change.post.status', $mainPost->id) }}"
                                    class="btn btn-{{ $mainPost->status == 0 ? 'warning' : 'dark' }}">
                                    {{ $mainPost->status == 0 ? 'Active' : 'Block' }}
                                </a>
                                <form action="{{ route('admin.posts.destroy', $mainPost->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Do you want to delete this post?');">Delete</button>
                                </form>

                            </center>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="comment-section">
                <!-- Comment Input -->
                @if ($mainPost->comment_able == 1)
                    <form id="commentForm">
                        <div class="comment-input">
                            @csrf
                            <input id="commentInput" type="text" name='comment' placeholder="Add a comment..." />
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="post_id" value="{{ $mainPost->id }}">
                            <button id="addCommentBtn" type="submit">Comment</button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-info">
                        no comments
                    </div>
                @endif --}}


                {{-- valdation error --}}
                {{-- <div id="errorMsg" style="display:none" class="alert alert-danger">

                </div> --}}

                <!-- Display Comments -->


                {{-- <div class="comments">
                    @foreach ($mainPost->comments as $comment)
                        <div class="comment">
                            <img src="{{ asset($comment->user->image) }}" alt="User Image" class="comment-img" />
                            <div class="comment-content">
                                <span class="username">{{ $comment->user->name }}</span>
                                <p class="comment-text">{{ $comment->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                    <!-- Add more comments here for demonstration -->
                </div> --}}



                <!-- Show More Button -->
                {{-- @if ($mainPost->comments()->count() > 2)
                    <button id="showMoreBtn" class="show-more-btn">Show more</button>
                @endif --}}
            {{-- </div> --}}
        </div>






    </div>

    <div class="dashboard container">
        <!-- Main Content -->
        <div class="main-content">
            <div class="container">

                <div class="row">
                    <div class="col-6">
                        <h2 class="mb-4">Comments</h2>
                    </div>
                </div>
                @forelse ($mainPost->comments as $comment  )
                 {{-- <a onclick="return confirm('Are you sure you want to delete all notifications?')" href="{{ $notification->data['link'] }}?notification={{ $notification->id }}"> --}}
                    <div class="notification alert alert-info">
                        <img src="{{asset($comment->user->image)}}" class="rounded-circle" style="width: 30px" alt="user image">
                             <strong> <a href="{{route('admin.users.show', $comment->user->id)}}" style="text-decoration: none">  {{   $comment->user->name }}</a></strong> :  {{ $comment->comment }} <br>
                           <span class="text-primary"> {{$comment->created_at->diffforHumans() }}</span>


                        <div class="float-right">
                            <form id="deleteItem" action="{{route('admin.delete.posts.comment',$comment->id)}}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </a>

                @empty
                <a href="">
                    <div class="notification alert alert-info">
                        <strong> No commnets </strong>
                    </div>
                </a>
                @endforelse


            </div>
        </div>
    </div>

@endsection
