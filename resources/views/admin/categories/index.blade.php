@extends('admin.app')

@section('title', 'All Categories')

@section('content')



    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.categories.create') }}" class=" btn btn-primary">Add category</a>
            </div>

            @include('admin.filter.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->status == 1 ? 'Active' : 'Not Active' }}</td>
                                    <td>{{ $category->created_at->format('Y-m') }}</td>
                                    <td class="text-center col-3">
                                        {{-- <a href="{{route('admin.categories.edit', $category->id) }}" class="btn btn-primary">Edit</a> --}}
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editCategory-{{$category->id}}"> Edit </button>
                                        <a href="{{ route('admin.change.category.status', $category->id) }}"
                                            class="btn btn-{{ $category->status == 0 ? 'warning' : 'dark' }}">
                                            {{ $category->status == 0 ? 'Active' : 'Block' }}
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Do you want to delete this category?');">Delete</button>
                                        </form>

                                    </td>
                                </tr>

                                {{-- edit category --}}
                                @include('admin.categories.edit')
                           {{-- edit category --}}
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-info">No category</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $categories->appends(request()->input())->links() }}
                </div>
            </div>
        </div>

        <!-- Modal -->


    </div>


@endsection
<!-- Content Wrapper -->

<!-- End of Content Wrapper -->
