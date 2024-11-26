<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta
      content="Bootstrap News Template - Free HTML Templates"
      name="keywords"
    />
    <meta
      content="Bootstrap News Template - Free HTML Templates"
      name="description"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="{{asset('assets/frontend/img/favicon.ico')}}" rel="icon" />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap"
      rel="stylesheet"
    />

    <!-- CSS Libraries -->
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />
    <link href="{{asset('assets/frontend/lib/slick/slick.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/frontend/lib/slick/slick-theme.css')}}" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{asset('assets/frontend/css/style.css')}}" rel="stylesheet" />

    <!-- plugins -->
    <link href="{{asset('assets/vendor/file-input/css/fileinput.min.css')}}" rel="stylesheet" />
    <!-- summernote -->
    <link href="{{asset('assets/vendor/summernote/summernote-bs4.min.css')}}" rel="stylesheet" />
    @stack('headers')
  </head>

  <body>
    {{-- @dump($setting_info) --}}
    @include('layouts.frontend.header')

        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container">
                <ul class="breadcrumb">
                    @section('breadcrumb')
                    {{-- empty --}}
                    @show

                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->

  @yield('body')

@include('layouts.frontend.footer')

    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}

    @auth
    <script>
        role= "user"
         UserId = "{{ auth()->user()->id }}";
    </script>
    @endauth
    <script src="{{asset('build/assets/app-C0KcN0yq.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('assets/frontend')}}/lib/easing/easing.min.js"></script>
    <script src="{{asset('assets/frontend')}}/lib/slick/slick.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{asset('assets/frontend')}}/js/main.js"></script>
    <!-- file input -->
    <script src="{{asset('assets/vendor/file-input/js/fileinput.min.js')}}"></script>
    <script src="{{asset('assets/vendor/file-input/themes/fa5/theme.min.js')}}"></script>
    {{-- summernote --}}
    <script src="{{asset('assets/vendor/summernote/summernote-bs4.min.js')}}"></script>
    @stack('js')
  </body>
</html>
