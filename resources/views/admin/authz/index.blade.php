@extends('admin.app')

@section('title', 'All Roles')

@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.authz.create') }}" class=" btn btn-primary">Add Role</a>
            </div>

            {{-- @include('admin.filter.filter') --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th>Admins</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->role }}</td>
                                    <td>{{ implode(', ',$role->permissions) }}</td>

                                    <td>
                                        @foreach ($role->admins as $admin)
                                            {{ $admin->name }}
                                            @if (!$loop->last), @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $role->created_at->format('Y-m') }}</td>
                                    <td class="col-3">
                                        <a href="{{route('admin.authz.edit',$role->id)}}" class="btn btn-info">Edit</a>
                                        {{-- <a href="{{ route('admin.change.user.status', $user->id) }}"
                                            class="btn btn-{{ $user->status == 0 ? 'warning' : 'dark' }}">
                                            {{ $user->status == 0 ? 'Active' : 'Block' }}
                                        </a> --}}
                                        <form action="{{ route('admin.authz.destroy', $role->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Do you want to delete this role?');">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-info">No role</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


@endsection
<!-- Content Wrapper -->

<!-- End of Content Wrapper -->
