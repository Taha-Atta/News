    <!-- Top Bar Start -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="tb-contact">
                        <p><i class="fas fa-envelope"></i>{{ $setting_info->email }}</p>
                        <p><i class="fas fa-phone-alt"></i>{{ $setting_info->phone }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tb-menu">
                        @guest

                            <a href="{{ route('register') }}">Register</a>
                            <a href="{{ route('login') }}">Login</a>
                        @endguest
                        @auth
                            <a href="javascript:void(0)"
 onclick="if (confirm('Do you want to logout')){
                        document.getElementById('formLogout').submit()} return false">Logout</a>
                        @endauth
                        <form action="{{ route('logout') }}" id="formLogout" method="post">
                            @csrf
                            {{-- <a href="#"> <button type="submit">Logout</button></a> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Bar Start -->

    <!-- Brand Start -->
    <div class="brand">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4">
                    <div class="b-logo">
                        <a href="{{ route('frontend.index') }}">
                            <img src="{{ asset($setting_info->logo) }}" class="img-circle" alt="Logo" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <div class="b-ads">

                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <form action="{{ route('frontend.search') }}" method="post">
                        @csrf
                        <div class="b-search">
                            <input type="text" name="search" placeholder="Search" />
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Brand End -->

    <!-- Nav Bar Start -->
    <div class="nav-bar">
        <div class="container">
            <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                <a href="#" class="navbar-brand">MENU</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto">
                        <a href="{{ route('frontend.index') }}" class="nav-item nav-link active">Home</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                            <div class="dropdown-menu">
                                @foreach ($categories as $category)
                                    <a href="{{ route('frontend.category.posts', $category->slug) }}"
                                        class="dropdown-item" title="{{ $category->name }}">{{ $category->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ route('frontend.contact.index') }}" class="nav-item nav-link">Contact Us</a>
                        <a href="{{ route('frontend.dashboard.profile') }}" class="nav-item nav-link">Account</a>
                    </div>
                    <div class="social ml-auto">
                        <a href="{{ $setting_info->twitter }}" title="twitter"><i class="fab fa-twitter"></i></a>
                        <a href="{{ $setting_info->facebook }}" title="facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ $setting_info->instagram }}" title="instagram"><i class="fab fa-instagram"></i></a>
                        <a href="{{ $setting_info->youtube }}" title="youtube"><i class="fab fa-youtube"></i></a>
                    </div>
                    @auth
                        <div class="social ml-auto">
                            <a href="#" class="nav-link dropdown-toggle" id="notificationDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell"></i>
                                <span  id ="count_notification"class="badge badge-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown"
                                style="width: 300px;">
                                <h6 class="dropdown-header"> <a  class="important bg-transparent" href="{{route('frontend.dashboard.notifaction.show')}}"> All Notifications</a> </h6>
                                <h6 class="dropdown-header " >
                                    <a class="important bg-transparent" href="{{route('frontend.dashboard.notifaction.marakeAll')}}">Marek All as read </a>
                                </h6>

                                @forelse (auth()->user()->unreadNotifications()->take(7)->get()  as $notification)
                                    <div id="pusherrr_notification">
                                        <div class="dropdown-item d-flex justify-content-between align-items-center">
                                            <span>{{ $notification->data['user_name'] }} comment on {{ substr($notification->data['post_title'],0,9) }}... </span>
                                            <a href="{{ $notification->data['link'] }}?notifica={{ $notification->id }}"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </div>

                                @empty
                                    <div class="dropdown-item text-center"> All Notifications read </div>
                                @endforelse ()
                            </div>
                        </div>
                    @endauth

                </div>
            </nav>
        </div>
    </div>
    <!-- Nav Bar End -->
