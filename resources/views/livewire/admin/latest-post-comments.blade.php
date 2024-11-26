
<div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Comment</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latestPosts as $post)
                            <tr>
                                @can('posts')
                                <td>
                                    <a href="{{route('admin.posts.show',$post->id)}}">{{ $post->title }}</a>
                                </td>
                                @endcan
                                @cannot('posts')
                                <td>
                                   {{ $post->title }}
                                </td>
                                @endcannot

                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->comments_count }}</td>
                                <td>{{ $post->status == 1 ? 'Active' : 'Not Active' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-danger">no comments</div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>
        </div>

        {{-- <!-- Color System -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                        Primary
                        <div class="text-white-50 small">#4e73df</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                        Success
                        <div class="text-white-50 small">#1cc88a</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card bg-info text-white shadow">
                    <div class="card-body">
                        Info
                        <div class="text-white-50 small">#36b9cc</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                        Warning
                        <div class="text-white-50 small">#f6c23e</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                        Danger
                        <div class="text-white-50 small">#e74a3b</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card bg-secondary text-white shadow">
                    <div class="card-body">
                        Secondary
                        <div class="text-white-50 small">#858796</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card bg-light text-black shadow">
                    <div class="card-body">
                        Light
                        <div class="text-black-50 small">#f8f9fc</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card bg-dark text-white shadow">
                    <div class="card-body">
                        Dark
                        <div class="text-white-50 small">#5a5c69</div>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Comments</h6>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Post</th>
                            <th>Comment</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latestComment as $comment)
                            <tr>

                              @can('users')
                              <td>
                                <a href="{{route('admin.users.show', $comment->user->id)}}">{{ $comment->user->name }}</a>
                            </td>
                              @endcan
                              @cannot('users')
                              <td>
                              {{ $comment->user->name }}
                            </td>
                              @endcannot
                              @can('posts')
                              <td>
                                <a href="{{route('admin.posts.show', $comment->post->id)}}">{{ $comment->post->title }}</a>
                            </td>
                              @endcan
                              @cannot('posts')
                              <td>
                                {{ $comment->post->title }}
                            </td>
                              @endcannot

                                <td>{{Illuminate\Support\Str::limit($comment->comment, 20)  }}</td>
                                <td>{{ $comment->status == 1 ? 'Active' : 'Not Active' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td>
                                    <div colspan="4" class="alert alert-danger">no comments</div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

