@extends('admin.app')

@section('title', 'show contact')

@section('content')
    <div class="card-body">
        <a href="{{ route('admin.contact.index') }}" class="btn btn-primary ml-6">Back to contacts</a>
    </div>

    <center>
    <div class="card-body col-10 shadow">
        <div class="row">
            <div class="col-6">
                <h2>show contact : {{ $contact->name }}</h2> <br>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="Name :{{ $contact->name }}" class="form-control">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input disabled value=" title :{{ $contact->title }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="Email : {{ $contact->email }}" class="form-control">

                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="phone :{{ $contact->phone }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <p>{{$contact->body}}</p>

                </div>
            </div>


        </div>

            <a href="mailto:{{$contact->email}}?subject=Re={{urlencode($contact->title)}}" class="btn btn-info"> Replay </a>
            <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Do you want to delete this contact?');">Delete</button>
            </form>
        </div>
    </center>


@endsection
