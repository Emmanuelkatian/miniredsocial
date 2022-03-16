<?php

namespace App\Http\Controllers;

use App\Http\Requests\postNewCommentRequest;
use App\Http\Requests\postPostCommentRequest;
use Illuminate\Http\Request;
use Validator, Auth;
use App\Models\User;
use App\Models\Posts;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function postNewComment($param, postNewCommentRequest $request)
    {
        $comment = new Comments;
        $comment->user_id = Auth::id();
        $comment->post_id = $param;
        $comment->body = e($request->input('comment_body'));
        if ($comment->save()) :
            return back();
        endif;
    }

    public function postPostComment($param, postPostCommentRequest $request)
    {
        $c = Comments::find($param);
        $c->body = e($request->input('comment_body'));
        if ($c->save()) :
            return back();
        endif;
    }

    public function getDeleteComment($param)
    {
        $c = Comments::findOrFail($param);
        if ($c->delete()) :
            return back();
        endif;
    }
}
