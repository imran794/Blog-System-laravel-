<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SubcribeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminFavoriteController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AllAuthorcontroller;
use App\Http\Controllers\Author\ADashboardController;
use App\Http\Controllers\Author\APostController;
use App\Http\Controllers\Author\AuthorFavoriteController;
use App\Http\Controllers\Author\AuthorSettingController;
use App\Http\Controllers\Author\AuthorCommentController;
use App\Http\Controllers\FrontendSubcribeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;

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

Route::get('post/details/{slug}',[HomeController::class, 'Details'])->name('post.details');
Route::get('all/post',[HomeController::class, 'AllPost'])->name('all.post');
Route::get('category/post/{slug}',[HomeController::class, 'CategoryByPost'])->name('category.post');
Route::get('tag/post/{slug}',[HomeController::class, 'TagByPost'])->name('tag.post');


Route::get('author/profile/{username}',[HomeController::class, 'AuthorProfile'])->name('author.profile');


Route::get('post/search',[SearchController::class, 'PostSearch'])->name('post.search');




Route::post('/frontend/subcribe/store',[FrontendSubcribeController::class, 'store'])->name('frontend.subcribe.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::post('favorite/{post}/add',[FavoriteController::class, 'Add'])->name('favorite.add');

    Route::post('comment/{post}',[CommentController::class, 'CommnetStroe'])->name('commnet.stroe');
});


Route::group([ 'as' => 'admin.','prefix' => 'admin','middleware' => ['auth','admin']], function() {
    Route::get('dashboard',[DashboardController::class ,'index'])->name('dashboard');

    Route::get('setting',[SettingController::class,'index'])->name('setting');
    Route::put('update/profile',[SettingController::class,'Update'])->name('update.profile');
    Route::post('change/password',[SettingController::class,'ChangePassword'])->name('change.password');

   Route::resource('tag', TagController::class);
   Route::resource('category', CategoryController::class);
   Route::resource('post', PostController::class);

   Route::get('all/author',[AllAuthorcontroller::class, 'index'])->name('all.author');
   Route::delete('author/destroy/{id}',[AllAuthorcontroller::class, 'Destroy'])->name('author.destroy');

   Route::get('/pending/post',[PostController::class, 'pending'])->name('post.pending');
   Route::put('/post/{id}/approve',[PostController::class , 'approve'])->name('post.approve');

   Route::get('favorite/post/show',[AdminFavoriteController::class,'Show'])->name('favorite.post.show');

   Route::get('comment/show',[AdminCommentController::class,'CommentShow'])->name('comment.show');
   Route::delete('comment/destroy/{id}',[AdminCommentController::class,'CommentDestroy'])->name('comment.destroy');

   Route::resource('subcribe', SubcribeController::class);
});


Route::group([ 'as' => 'author.','prefix' => 'author', 'middleware' => ['auth','author']], function() {
    Route::get('dashboard',[ADashboardController::class ,'index'])->name('dashboard');

    Route::get('setting',[AuthorSettingController::class,'index'])->name('setting');
    Route::put('update/profile',[AuthorSettingController::class,'UpdateAuthor'])->name('update.profile');
    Route::post('change/password',[AuthorSettingController::class,'ChangePassword'])->name('change.password');

    Route::get('favorite/post/show',[AuthorFavoriteController::class,'Show'])->name('favorite.post.show');

   Route::get('comment/show',[AuthorCommentController::class,'CommentShow'])->name('comment.show');
   Route::delete('comment/destroy/{id}',[AuthorCommentController::class,'CommentDestroy'])->name('comment.destroy');

    Route::resource('post', APostController::class);
});
