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
        $comment =  Comment::findOrFail($id);
     
        if ($comment->post->user->id == Auth::id()) {
            $comment->delete();
              Toastr::success('Comment Successfully Published :)','Success');
             return redirect()->back();
        }
        else{
              Toastr::error('You are not authorized to delete this comment :)','Access Denied! !!');
           return redirect()->back();
        }
      
    }

}
