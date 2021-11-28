<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class SearchController extends Controller
{
    public function PostSearch(Request $request)
    {
        $request->validate([
            'query' => 'required'
        ]);

        $query = $request->input('query');
        $posts  = Post::where('title','LIKE','%'.$query.'%')->where('status',true)->where('is_approve',true)->paginate(3);
        return view('postsearch',compact('posts','query'));
    }
}
