<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SubcribeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminFavoriteController;
use App\Http\Controllers\Author\ADashboardController;
use App\Http\Controllers\Author\APostController;
use App\Http\Controllers\Author\AuthorFavoriteController;
use App\Http\Controllers\Author\AuthorSettingController;
use App\Http\Controllers\FrontendSubcribeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class, 'index'])->name('home');





Route::post('/frontend/subcribe/store',[FrontendSubcribeController::class, 'store'])->name('frontend.subcribe.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::post('favorite/{post}/add',[FavoriteController::class, 'Add'])->name('favorite.add');
});


Route::group([ 'as' => 'admin.','prefix' => 'admin','middleware' => ['auth','admin']], function() {
    Route::get('dashboard',[DashboardController::class ,'index'])->name('dashboard');

    Route::get('setting',[SettingController::class,'index'])->name('setting');
    Route::put('update/profile',[SettingController::class,'Update'])->name('update.profile');
    Route::post('change/password',[SettingController::class,'ChangePassword'])->name('change.password');

   Route::resource('tag', TagController::class);
   Route::resource('category', CategoryController::class);
   Route::resource('post', PostController::class);

   Route::get('/pending/post',[PostController::class, 'pending'])->name('post.pending');
   Route::put('/post/{id}/approve',[PostController::class , 'approve'])->name('post.approve');

   Route::get('favorite/post/show',[AdminFavoriteController::class,'Show'])->name('favorite.post.show');

   Route::resource('subcribe', SubcribeController::class);
});


Route::group([ 'as' => 'author.','prefix' => 'author', 'middleware' => ['auth','author']], function() {
    Route::get('dashboard',[ADashboardController::class ,'index'])->name('dashboard');

    Route::get('setting',[AuthorSettingController::class,'index'])->name('setting');
    Route::put('update/profile',[AuthorSettingController::class,'UpdateAuthor'])->name('update.profile');
    Route::post('change/password',[AuthorSettingController::class,'ChangePassword'])->name('change.password');

    Route::get('favorite/post/show',[AuthorFavoriteController::class,'Show'])->name('favorite.post.show');

    Route::resource('post', APostController::class);
});
