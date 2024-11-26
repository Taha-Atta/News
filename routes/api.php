<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('auth/login',[LoginController::class,'login']);
Route::delete('auth/logout',[LoginController::class,'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts',[GeneralController::class,'posts']);
Route::get('posts/show/{slug}',[GeneralController::class,'showPost']);
Route::get('posts/comment/{slug}',[GeneralController::class,'showPostComment']);


Route::post('posts/search',[GeneralController::class,'shearchPosts']);

//****************************category route */
Route::get('categories',[CategoryController::class,'allCategories']);
Route::get('categories/{slug}/posts',[CategoryController::class,'CategoriesPosts']);

//****************************contact us route */
Route::post('contact/store',[ContactController::class,'Contact']);

//****************************setting route */
Route::get('setting',[SettingController::class,'showSetting']);
