<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Comment;


class AdminCommentController extends Controller
{
    public function CommentShow()
    {
        return view('admin.comment.show',[
            'comments' => Comment::latest()->get()
        ]);
    }

    public function CommentDestroy($id)
    {
        Comment::find($id)->delete();
        Toastr::success('Comment Successfully Published :)','Success');
        return redirect()->back();
    }
}
