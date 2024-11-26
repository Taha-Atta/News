<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\FrogetPasswordController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\loginAdminController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\post\postController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\AuthzController;
use App\Http\Controllers\Frontend\CategoreisController;

// Route::prefix('admin')->name('admin.')->group(function(){

// });



Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::fallback(function(){
        return abort(404);
    });



    Route::get('login', [loginAdminController::class, 'showlogin'])->name('show.login');
    Route::post('login/admin', [loginAdminController::class, 'loginAdmin'])->name('login');
    Route::post('logout/admin', [loginAdminController::class, 'logoutAdmin'])->name('logout');

    Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
        Route::get('email', [FrogetPasswordController::class, 'showEmail'])->name('show.email');
        Route::post('email', [FrogetPasswordController::class, 'checkEmail'])->name('check.email');
        Route::get('confirm/{email}', [FrogetPasswordController::class, 'confirmcode'])->name('confirm.code');
        Route::post('verfiy/otp', [FrogetPasswordController::class, 'verfiyOtp'])->name('verfiy.otp');


        Route::get('reset/{email}', [ResetPasswordController::class, 'showReset'])->name('show.Reset');
        Route::post('reset', [ResetPasswordController::class, 'resetPassword'])->name('reseet.password');
    });
});
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:admin','CheckStatusAdmin']], function () {
    Route::fallback(function(){
        return abort(404);
    });

    Route::get('home', [HomeController::class,'index'])->name('index');

    Route::resource('authz', AuthzController::class);
    Route::resource('users', UserController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('posts', postController::class);
    Route::resource('categories', CategoryController::class);

    Route::get('users/change/status/{id}', [UserController::class, 'changeStatus'])->name('change.user.status')->middleware('can:users');
    Route::get('admins/change/status/{id}', [AdminController::class, 'changeStatus'])->name('change.admin.status')->middleware('can:admin');
    Route::get('posts/change/status/{id}', [postController::class, 'changeStatus'])->name('change.post.status')->middleware('can:posts');
    Route::post('/delete/posts/image/{id}', [postController::class, 'deletePostImage'])->name('delete.posts.image')->middleware('can:posts');
    Route::delete('/delete/posts/comment/{id}', [postController::class, 'deletePostComment'])->name('delete.posts.comment')->middleware('can:posts');
    Route::get('categories/change/status/{id}', [CategoryController::class, 'changeStatus'])->name('change.category.status')->middleware('can:category');

    // *****************************profile route
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/{email}', 'index')->name('profile.index');
        Route::get('/profile/showverfiycode/{email}', 'showverfiycode')->name('profile.showverfiycode');
        Route::post('/profile/verfiycode', 'verfiycode')->name('profile.verfiycode');
        Route::post('/update/profile/{id}', 'updateprofile')->name('profile.update');
    });
    // *****************************setting route
    Route::controller(SettingController::class)->group(function () {
        Route::get('/setting', 'index')->name('setting.index');
        Route::post('/update/setting', 'updateSetting')->name('setting.update');
    });
    // *****************************contact route
    Route::controller(ContactController::class)->group(function () {
        Route::get('/contact', 'index')->name('contact.index');
        Route::get('/show/contact/{id}', 'showContact')->name('contact.show');
        Route::delete('/delete/contact/{id}', 'deleteContact')->name('contact.destroy');
    });
    // *****************************Notifaction route
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/notification', 'index')->name('notification.index');
        Route::delete('/delete/notification/{id}', 'deleteItem')->name('notification.destroy');
        Route::delete('/delete/notifications/', 'deleteAll')->name('notification.deleteAll');
    });


});
