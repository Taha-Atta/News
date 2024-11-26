@extends('admin.app')

@section('title', 'All Posts')

@section('content')

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.posts.create') }}" class=" btn btn-primary">Create Post</a>
            </div>

            @include('admin.posts.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>User</th>
                                <th>Views</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @forelse ($posts as $post)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->category->name }} </td>
                                    <td>{{ $post->status == 1 ? 'Active' : 'Not Active' }}</td>
                                    <td>{{ $post->user->name ?? $post->admin->name }}</td>
                                    <td>{{ $post->num_of_views }}</td>
                                    <td>
                                        <a href="{{route('admin.posts.show',['post'=>$post->id,'page'=>request()->page])}}" class="btn btn-info">show</a>
                                        @if ($post->user_id == null)
                                        <a href="{{route('admin.posts.edit',$post->id)}}" class="btn btn-primary">Edit</a>
                                        @endif
                                        <a href="{{ route('admin.change.post.status', $post->id) }}"
                                            class="btn btn-{{ $post->status == 0 ? 'warning' : 'dark' }}">
                                            {{ $post->status == 0 ? 'Active' : 'Block' }}
                                        </a>
                                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Do you want to delete this post?');">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-info">No post</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $posts->appends(request()->input())->links() }}
                </div>
            </div>
        </div>

    </div>


@endsection
<!-- Content Wrapper -->

<!-- End of Content Wrapper -->
