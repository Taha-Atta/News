@extends('admin.app')

@section('title', 'All contact')

@section('content')



    <div class="container-fluid">




        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">contacts</h6>
            </div>

            @include('admin.contact.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>phone</th>
                                <th>Created at</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($contacts as $contact)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $contact->title }} </td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }} </td>
                                    <td>{{ $contact->status == 0 ? 'Unread' : 'Read' }} </td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->created_at->diffForHumans() }}</td>
                                    <td class="col-3 text-center">
                                        <a href="{{ route('admin.contact.show', $contact->id) }}" class="btn btn-info">Show</a>

                                        <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST"
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
                    {{ $contacts->appends(request()->input())->links() }}
                </div>
            </div>
        </div>

    </div>


@endsection
<!-- Content Wrapper -->

<!-- End of Content Wrapper -->
