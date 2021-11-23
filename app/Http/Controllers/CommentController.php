<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Comment;
use Auth;


class CommentController extends Controller
{
    public function CommnetStroe(Request $request, $post)
    {
        $request->validate([
            'comment'  => 'required'
        ]);

        $comment = new Comment();

        $comment->user_id = Auth::id();
        $comment->post_id = $post;
        $comment->comment = $request->comment;
        $comment->save();
         Toastr::success('Comment Successfully Published :)','Success');
        return redirect()->back();
    }
}
