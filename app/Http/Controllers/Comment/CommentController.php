<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Models\Post\Post;

class CommentController extends Controller
{
    public function create_comment(StoreCommentRequest $request, $post_id)
    {
        $post = Post::findOrFail($post_id);
        $request->validated();
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'parent_id' => $post_id,
        ];

        $post->comments()->create($data);

        return response()->json(['success' => true]);
    }

    public function get_post_comment($id)
    {
        $post = Post::findOrFail($id);
        $post->user;
        $post->comments;
        return  $post;
    }
}
