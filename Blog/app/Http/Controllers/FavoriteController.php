<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

class FavoriteController extends Controller
{
    public function Add($post)
    {
        $user = Auth::user();

        $isFavorite = $user->favorite_posts()->where('post_id',$post)->count();

        if ($isFavorite == 0) {
           $user->favorite_posts()->attach($post);
            Toastr::success('Post Successfully added to your Favorite List :)','Success');
            return redirect()->back();
        }
        else{
              $user->favorite_posts()->detach($post);
             Toastr::error('Post Successfully Removed to your Favorite List :)','Error');
            return redirect()->back();
        }
    }
}
