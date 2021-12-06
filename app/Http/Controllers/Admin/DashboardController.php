<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Carbon\carbon;


class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $popular_posts = Post::withCount('comments')
                         ->withCount('favorite_to_users')
                         ->orderby('comments_count','desc')
                         ->orderby('favorite_to_users_count','desc')
                         ->orderby('view_count','desc')
                         ->take('5')->get();
         $total_pending_post = Post::where('is_approve',false)->count();
         $all_views = Post::sum('view_count');
         $all_author = User::where('role_id',2)->count();
         $today_author = User::where('role_id',2)->whereDate('created_at',Carbon::today())->count();
         $active_author = User::where('role_id',2)
                          ->withCount('comments')           
                          ->withCount('posts')           
                          ->withCount('favorite_posts')           
                          ->orderby('comments_count','desc')           
                          ->orderby('posts_count','desc')           
                          ->orderby('favorite_posts_count','desc')->take(10)->get();
          $category_count = Category::all()->count();
          $tag_count      = Tag::all()->count();                    

        return view('admin.index',compact('posts','popular_posts','total_pending_post','all_views','all_author','today_author','active_author','category_count','tag_count'));
    }
}
