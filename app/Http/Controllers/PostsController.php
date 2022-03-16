<?php

namespace App\Http\Controllers;

use App\Http\Requests\postNewPostRequest;
use App\Http\Requests\postPostEditRequest;
use Illuminate\Http\Request;
use Validator, Auth, DB;
use App\Models\User;
use App\Models\Posts;
use App\Models\Comments;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getFeedPost()
    {

        $reads = Posts::with(['comment', 'user'])->orderBy('updated_at', 'DESC')->get();

        $data = ['reads' => $reads];
        return view('feed', $data);
    }

    public function postNewPost(postNewPostRequest $request)
    {

        $u = User::find(Auth::id());
        $post = new Posts;
        $post->user_id = $u->id;
        $post->body = e($request->input('content_post'));
        if ($post->save()) :
            return back();
        endif;
    }

    public function getPostEdit($param)
    {
        $post = Posts::findOrFail($param);
        $data = ['post' => $post];
        return view('feed_edit', $data);
    }

    public function postPostEdit($param, postPostEditRequest $request)
    {
        $post = Posts::find($param);
        $post->body = e($request->input('content_post'));
        if ($post->save()) :
            return back();
        endif;
    }

    public function getDeletePost($param)
    {
        $p = Posts::findOrFail($param);
        if ($p->delete()) :
            return back();
        endif;
    }
}
