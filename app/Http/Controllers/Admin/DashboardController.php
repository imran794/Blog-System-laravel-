<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

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
                         ->take('5') 

        return view('admin.index');
    }
}
