<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Comment;
use Auth;

class AuthorCommentController extends Controller
{
    public function CommentShow()
    {
        return view('author.comment.show',[
            'posts' => Auth::user()->posts
        ]);
    }

    public function CommentDestroy($id)
    {
        Comment::find($id)->delete();
        Toastr::success('Comment Successfully Published :)','Success');
        return redirect()->back();
    }

}
