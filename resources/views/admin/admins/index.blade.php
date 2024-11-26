@extends('admin.app')

@section('title', 'All Admins')

@section('content')


    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Admins</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.admins.create') }}" class=" btn btn-primary">Add Admin</a>
            </div>

     
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($admins as $admin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->email }} </td>
                                    <td>{{ $admin->role->role ?? null}} </td>
                                    <td>{{ $admin->status == 1 ? 'Active' : 'Not Active' }}</td>
                                    <td>{{ $admin->created_at->format('Y-m') }}</td>
                                    <td class="col-3">
                                        <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ route('admin.change.admin.status', $admin->id) }}"
                                            class="btn btn-{{ $admin->status == 0 ? 'warning' : 'dark' }}">
                                            {{ $admin->status == 0 ? 'Active' : 'Block' }}
                                        </a>
                                        <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Do you want to delete this admin?');">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-info">No admin</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $admins->appends(request()->input())->links() }}

                </div>
            </div>
        </div>




    </div>


@endsection
<!-- Content Wrapper -->

<!-- End of Content Wrapper -->
