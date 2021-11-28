<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\User;

class AllAuthorcontroller extends Controller
{
    public function index()
    {
       
        return view('admin.allauthor.index',[
         'authors' => User::authors()->withcount('posts')->withcount('favorite_posts')->withcount('comments')->get()
        ]);
    }

    public function Destroy($id)
    {
       return User::findOrFail($id);
        Toastr::success('Author Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
