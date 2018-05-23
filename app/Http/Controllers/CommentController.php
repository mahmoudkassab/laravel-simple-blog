<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function storeComment(Request $request){
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->article_id = $request->article_id;
        $comment->user_id = $request->user_id;
        $comment->save();
        return back();
    }

    public function deleteComment($id){
        $comment = Comment::find($id);
        $user = User::find($comment->user_id);
        if ($user->id == Auth::id()) {
            $comment->delete();
        }
        return back();
    }
}
