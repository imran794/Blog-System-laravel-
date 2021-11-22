<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthorFavoriteController extends Controller
{
     public function Show()
    {
        return view('author.favorite.index',[
            'posts' => Auth::user()->favorite_posts
        ]);
    }
}
