<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ADashboardController extends Controller
{
   public function index()
    {
      $user = Auth::user();
      $posts = $user->posts;
      $popular_posts = $user->posts()->withcount('comments')->withcount('favorite_to_users')
      ->orderby('view_count','desc')
      ->orderby('comments_count')
      ->orderby('favorite_to_users_count')
      ->take(5)
      ->get();
      $pending_post = $posts->where('is_approve',false)->count();
      $all_view = $posts->sum('view_count');
        return view('author.index',compact('popular_posts','pending_post','all_view','posts'));
    }
}
