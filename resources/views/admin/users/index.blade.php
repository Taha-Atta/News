@extends('admin.app')

@section('title', 'All Users')

@section('content')



    <div class="container-fluid">




        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.users.create') }}" class=" btn btn-primary">Add User</a>
            </div>

            @include('admin.filter.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Country</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }} </td>
                                    <td>{{ $user->status == 1 ? 'Active' : 'Not Active' }}</td>
                                    <td>{{ $user->country }}</td>
                                    <td>{{ $user->created_at->format('Y-m') }}</td>
                                    <td class="col-3">
                                        <a href="{{route('admin.users.show',$user->id)}}" class="btn btn-info">show</a>
                                        <a href="{{ route('admin.change.user.status', $user->id) }}"
                                            class="btn btn-{{ $user->status == 0 ? 'warning' : 'dark' }}">
                                            {{ $user->status == 0 ? 'Active' : 'Block' }}
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Do you want to delete this user?');">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-info">No user</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->appends(request()->input())->links() }}
                </div>
            </div>
        </div>

    </div>


@endsection
<!-- Content Wrapper -->

<!-- End of Content Wrapper -->
