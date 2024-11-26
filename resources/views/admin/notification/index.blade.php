@extends('admin.app')

@section('title', 'All Notifiaction')

@section('content')

    <div class="dashboard container">
        <!-- Main Content -->
        <div class="main-content">
            <div class="container">

                <div class="row">
                    <div class="col-6">
                        <h2 class="mb-4">Notifications</h2>
                    </div>
                    <div class="col-6">
                        {{-- <a href="{{route('frontend.dashboard.notifaction.deleteAll')}}" style="margin-left: 270px" class="btn btn-sm btn-danger">Delete All</a> --}}
                        <form action="{{ route('admin.notification.deleteAll') }}" method="POST"
                            style="display: inline;margin-left: 270px">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure you want to delete all notifications ??')"
                                class="btn btn-danger btn-sm">Delete All</button>
                        </form>
                    </div>
                </div>
                @forelse ($notifications as $notification)
                    {{-- <a onclick="return confirm('Are you sure you want to delete all notifications?')" href="{{ $notification->data['link'] }}?notification={{ $notification->id }}"> --}}
                    <div class="notification alert alert-info">

                        <strong>You have a notification from {{ $notification->data['name'] }} </strong> : <a
                            style="text-decoration: none"
                            href="{{ $notification->data['link'] }} ?notifiy_admin = {{ $notification->id }}">{{ $notification->data['title'] }}</a>
                        <br>
                        {{ $notification->created_at->diffforHumans() }}


                        <div class="float-right">
                            <form id="deleteItem" action="{{ route('admin.notification.destroy', $notification->id) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure you want to delete this item?')"
                                    class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                    </a>

                @empty
                    <a href="">
                        <div class="notification alert alert-info">
                            <strong> No Notification </strong>
                        </div>
                    </a>
                @endforelse

                {{ $notifications->links() }}
            </div>
        </div>
    </div>




@endsection
