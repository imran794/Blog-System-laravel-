<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Session;
use App\Models\User;

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
            'posts' => Post::where('is_approve',true)->where('status',true)->latest()->take(7)->get(),
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

        $randomposts = Post::where('is_approve',true)->where('status',true)->take(3)->get();
        return view('post_details',compact('post','randomposts'));
    }

    public function AllPost()
    {
        return view('posts',[
            'posts' => Post::latest()->paginate(3)
        ]);
    }

    public function CategoryByPost($slug)
    {
        $category = Category::where('slug',$slug)->first();
        $posts = $category->posts()->where('is_approve',true)->where('status',true)->get();
        return view('categorybypost', compact('category','posts'));
        
    }

    public function TagByPost($slug)
    {
        $tag = Tag::where('slug',$slug)->first();
        $posts = $tag->posts()->where('is_approve',true)->where('status',true)->get();
        return view('tagbypost',compact('tag','posts'));
    }

    public function AuthorProfile($username)
    {    
         $author = User::where('username',$username)->first();
         $posts = $author->posts()->where('is_approve',true)->where('status',true)->get();
       return view('authprofile',compact('author','posts'));
    }
}
