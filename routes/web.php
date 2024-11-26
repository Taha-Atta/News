<?php

use App\Http\Controllers\Auth\SocailLoginController;
use App\Http\Controllers\Frontend\CategoreisController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\Dashboard\NotifactionController;
use App\Http\Controllers\Frontend\Dashboard\ProfileController;
use App\Http\Controllers\Frontend\Dashboard\SettingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewSubsciberController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\SearchController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group([
    'as' => 'frontend.'
], function () {
    Route::fallback(function(){
        return abort(404);
    });
    Route::get('/home', [HomeController::class, 'index'])->name('index');
    Route::post('new-subscriber', [NewSubsciberController::class, 'store'])->name('new.subsceiber');
    Route::get('/category/{slug}', CategoreisController::class)->name('category.posts');
    Route::get('/checkstatus/', function()
    { return view('wait');})->name('checkstatus');

    // post routes
    Route::controller(PostController::class)->name('post.')->prefix('post')->group(function () {
        Route::get('/{slug}', 'show')->name('show');
        Route::get('/comment/{slug}', 'getAllcomment')->name('allComment');
        Route::post('/comment/store', 'storeComment')->name('store.comment');
    });

    // cantact routs
    Route::controller(ContactController::class)->name('contact.')->prefix('/contact_us')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
    });

    // search controller
    Route::match(['get', 'post'], '/search', SearchController::class)->name('search');


    // User Dashboard
    Route::prefix('account')->name('dashboard.')->middleware(['auth', 'verified','checkstatus'])->group(function () {

        Route::controller(ProfileController::class)->group(function () {

            Route::get('/profile', 'index')->name('profile');
            Route::post('/add/post', 'addPost')->name('add.post');

            Route::get('/edit/post/{slug}', 'editPost')->name('edit.post');
            Route::put('/update/post/{id}', 'updatePost')->name('update.post');

            Route::delete('/delete/post/{slug}', 'deletePost')->name('delete.post');
            Route::get('/comment/post/{id}', 'commentPost')->name('comment.post');

            Route::post('/delete/post/image/{id}', 'deletePostImage')->name('delete.post.image');
        });

        Route::controller(SettingController::class)->group(function(){
            Route::get('setting','index')->name('setting.index');
            Route::post('setting/update','updateSetting')->name('setting.update');
            Route::post('setting/password','changepassword')->name('setting.changepassword');
        });

        Route::prefix('notifaction')->controller(NotifactionController::class)->group(function(){


            Route::get('/showNotification','showNotification')->name('notifaction.show');
            Route::get('/markeall','markeAll')->name('notifaction.marakeAll');
            Route::delete('/delete/all','deleteAll')->name('notifaction.deleteAll');
            Route::delete('/delete/item/{notification_id}','deleteItem')->name('notifaction.deleteItem');
        });
    });
});






Auth::routes(['verify' => true]);
//****************************************google login *****************//
Route::get('auth/{provider}/redirect',[SocailLoginController::class,'redirect'])->name('auth.google.redirect');
Route::get('auth/{provider}/callback',[SocailLoginController::class,'callback'])->name('auth.google.callback');
//****************************************google login *****************//


