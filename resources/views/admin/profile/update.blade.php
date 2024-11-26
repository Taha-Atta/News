@extends('admin.app')

@section('title', 'Update profile')

@section('content')

    <div class="d-flex justify-content-center">
        <form action="{{ route('admin.profile.update',$admin->id) }}" method="post" >
            @csrf
            <div class="card-body shadow mt-4" style="min-width: 100ch">
                @include('error')
                <h2 class="text-center">Profile</h2> <br>
                 <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{ $admin->name }}" class="form-control">
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">User name</label>
                            <input type="text" name="username" value="{{ $admin->username }}" class="form-control">
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" value="{{ $admin->email }}" class="form-control">
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password"  placeholder="if you dont change, password still the sam"  class="form-control">
                        </div>
                    </div>
                </div>
                <button type="submit"  class="btn btn-primary text-center">Update profile</button>
            </div>
        </form>
    </div>




@endsection


@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drop a file here',
                'replace': 'Drag to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }

        });
    </script>
@endpush
