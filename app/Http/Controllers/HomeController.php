<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome',[
            'categories' => Category::latest()->get(),
            'posts' => Post::where('is_approve',true)->latest()->take(6)->get(),
        ]);
    }

    public function Details($slug)
    {
        $post = Post::where('slug',$slug)->first();

        $blogkey = 'blog_' . $post->id;

        if (!Session::has($blogkey)) {
            $post->increment('view_count');
            Session::put($blogkey,1);
        }

        $randomposts = Post::all()->random(3);
        return view('post_details',compact('post','randomposts'));
    }

    public function AllPost()
    {
        return view('posts',[
            'posts' => Post::latest()->paginate(3)
        ]);
    }
}
