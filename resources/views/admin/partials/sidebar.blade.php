<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> {{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    @can('home')
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
    @endcan


    <!-- Divider -->
    <hr class="sidebar-divider">

    @can('notify')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.notification.index') }}">
            <i class="fa fa-bell" aria-hidden="true"></i>

            <span>Notification</span></a>
    </li>
    @endcan

    <!-- Nav Item - Pages Collapse Menu -->
    @can('posts')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-book" aria-hidden="true"></i>
                 <span>Post Mangement</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item" href="{{ route('admin.posts.index') }}">Posts</a>
                    <a class="collapse-item" href="{{ route('admin.posts.create') }}">Create Post</a>
                </div>
            </div>
        </li>
    @endcan

    <!-- Nav Item - Utilities Collapse Menu -->
    @can('admin')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#adminMangment"
                aria-expanded="true" aria-controls="adminMangment">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>Admin Mangement</span>
            </a>
            <div id="adminMangment" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item" href="{{ route('admin.admins.index') }}">Admins</a>
                    <a class="collapse-item" href="{{ route('admin.admins.create') }}">Create admin</a>

                </div>
            </div>
        </li>
    @endcan
    @can('setting')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-cog"></i>
                <span>Setting</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item" href="{{ route('admin.setting.index') }}">Setting</a>

                </div>
            </div>
        </li>
    @endcan




    <!-- Nav Item - Pages Collapse Menu -->
    @can('authrization')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#role" aria-expanded="true"
                aria-controls="role">
                <i class="fas fa-fw fa-folder"></i>
                <span>Roles</span>
            </a>
            <div id="role" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item" href="{{ route('admin.authz.index') }}">Roles</a>
                    <a class="collapse-item" href="{{ route('admin.authz.create') }}">Create Role</a>

                </div>
            </div>
        </li>
    @endcan

    @can('users')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-users"></i>
                <span>User Mangement</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.users.index') }}">Users</a>
                    <a class="collapse-item" href="{{ route('admin.users.create') }}">Add User</a>
                </div>
            </div>
        </li>
    @endcan


    <!-- Nav Item - Charts -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li> --}}

    <!-- Nav Item - Tables -->
    @can('category')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.categories.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Categories</span></a>
        </li>
    @endcan
    @can('contact')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.contact.index') }}">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>

                <span>Contact</span></a>
        </li>
    @endcan


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>




</ul>
