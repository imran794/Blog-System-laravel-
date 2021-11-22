<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;


class AdminFavoriteController extends Controller
{
    public function Show()
    {
        return view('admin.favorite.index',[
            'posts' => Auth::user()->favorite_posts
        ]);
    }
}
