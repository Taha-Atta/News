<?php

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OtpController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Account\PostController;
use App\Http\Controllers\Api\Password\ResetPassword;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Password\ForgetPassword;
use App\Http\Controllers\Api\Account\GetUserController;
use App\Http\Controllers\Api\Account\NotificationController;
use App\Http\Controllers\Api\Account\SettingController as AccountSettingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//****************************Register route *************************/
Route::post('auth/register', [RegisterController::class, 'register']);

//****************************login route *************************/
Route::controller(LoginController::class)->group(function () {
    Route::post('auth/login', 'login');
    Route::delete('auth/logout', 'logout')->middleware('auth:sanctum');
});
//****************************verify Email route *************************/
Route::controller(OtpController::class)->middleware('auth:sanctum')->group(function () {
    Route::post('auth/verify/email', 'verifyEmail');
    Route::get('auth/send/code/agian', 'sendCodeAgian');
});
//****************************forgetpassword route *************************/
Route::controller(ForgetPassword::class)->group(function () {
    Route::post('forget/password', 'forgetPassword');
});
//****************************rest password route *************************/
Route::controller(ResetPassword::class)->group(function () {
    Route::post('reset/password', 'resetPassword');
});
//**********************************User Account***************************************** */
Route::middleware(['auth:sanctum','checkstatus'])->prefix('account')->group(function () {


    // Route::get('/user', function (Request $request) {
    //     return new UserResource($request->user());});
    Route::get('/user',[GetUserController::class,'getUser']);

    Route::put('setting/{user_id}',[AccountSettingController::class,'updateSetting']);
    Route::put('password/{user_id}',[AccountSettingController::class,'updatePassword']);
    Route::controller(PostController::class)->prefix('posts')->group(function () {
        Route::get('/',                                'getPosts');
        Route::post('/store',                          'storePosts');
        Route::put('/update/{podt_id}',                'updatePost');
        Route::delete('/delete/{post_id}',             'deletePost');

        Route::get('/comments/{post_id}',               'getPostComments');
        Route::post('/store/comment',                   'storePostComment');

    Route::get('/get/notification',[NotificationController::class,'getNotification']);
    Route::get('/read/notification/{id}',[NotificationController::class,'ReadNotification']);
});
});


//****************************Home Page route *************************/
Route::controller(GeneralController::class)->group(function () {

    Route::get('posts', 'posts');
    Route::get('posts/show/{slug}', 'showPost');
    Route::get('posts/comment/{slug}', 'showPostComment');
    Route::post('posts/search', 'shearchPosts');
});

//****************************category route *************************/
Route::controller(CategoryController::class)->group(function () {

    Route::get('categories', 'allCategories');
    Route::get('categories/{slug}/posts', 'CategoriesPosts');
});

//****************************contact us route ***********************/
Route::post('contact/store', [ContactController::class, 'Contact'])->middleware('throttle:contact');

//****************************setting route ***************************/
Route::get('setting', [SettingController::class, 'showSetting']);
