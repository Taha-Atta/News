@extends('admin.app')

@section('title', 'Update Setting')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush

@section('content')

    <div class="d-flex justify-content-center">
        <form action="{{ route('admin.setting.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body shadow mt-4" style="min-width: 100ch">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2 class="text-center">Update Setting</h2> <br>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="site_name" value="{{ $setting_info->site_name }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="email" name="email" value="{{ $setting_info->email }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="country" value="{{ $setting_info->country }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="phone" value="{{ $setting_info->phone }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="street" value="{{ $setting_info->street }}" class="form-control">

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="city" value="{{ $setting_info->city }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="twitter" value="{{ $setting_info->twitter }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="facebook" value="{{ $setting_info->facebook }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="instagram" value="{{ $setting_info->instagram }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="youtube" value="{{ $setting_info->youtube }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            favicon: <input type="file" name="favicon"  data-default-file="{{ asset($setting_info->favicon )}}"  class="dropify">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            logo: <input type="file" name="logo"  data-default-file="{{ asset($setting_info->logo) }}"  class="dropify">

                        </div>
                    </div>
                </div>
                <input type="text" name="setting_info_id" hidden value="{{ $setting_info->id }}">
                <button type="submit"  class="btn btn-primary text-center">Update Setting</button>
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
