@extends('layouts.frontend.app')

@section('title', 'Setting')

@section('body')
    <!-- Dashboard Start-->

    <div class="dashboard container">
        <!-- Sidebar -->
        @include('frontend.dashboard._sidebar',['setting_active'=>'active'] )
        <!-- Main Content -->
        <div class="main-content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Settings Section -->
            <section id="settings" class="content-section">
                <h2>Settings</h2>
                <form class="settings-form" method="post" action="{{ route('frontend.dashboard.setting.update') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">name:</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}" />
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="{{ $user->username }}" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" />
                    </div>
                    <div class="form-group">
                        <label for="profile-image">Profile Image:</label>
                        <input type="file" id="profile-image" name="image" accept="image/*" />
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" value="{{ $user->country }}"
                            placeholder="Enter your country" />
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" value="{{ $user->city }}"
                            placeholder="Enter your city" />
                    </div>
                    <div class="form-group">
                        <label for="street">Street:</label>
                        <input type="text" id="street" name="street" value="{{ $user->street }}"
                            placeholder="Enter your street" />
                    </div>
                    <div class="form-group">
                        <label for="phone">phone:</label>
                        <input type="text" id="phone" name="phone" value="{{ $user->phone }}"
                            placeholder="Enter your phone" />
                    </div>
                    <button type="submit" class="save-settings-btn">
                        Save Changes
                    </button>
                </form>

                <!-- Form to change the password -->
                <form class="change-password-form" method="POST" action="{{route('frontend.dashboard.setting.changepassword')}}">
                    @csrf
                    <h2>Change Password</h2>
                    <div class="form-group">
                        <label for="current-password">Current Password:</label>
                        <input type="password" name="current_password" id="current-password" placeholder="Enter Current Password" />
                        @error('current_password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password:</label>
                        <input type="password" name="password" id="new-password" placeholder="Enter New Password" />
                        @error('new_password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password:</label>
                        <input type="password" name="password_confirmation" id="confirm-password" placeholder="Enter Confirm New " />
                        @error('password_confirmation')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="change-password-btn">
                        Change Password
                    </button>
                </form>
            </section>
        </div>
    </div>

    <!-- Dashboard End-->
@endsection
