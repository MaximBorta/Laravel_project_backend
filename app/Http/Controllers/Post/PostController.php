<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Requests\Post\UploadPostRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api", ["except" => ["login", "register"]]);
    }

    public function store(StorePostRequest $request)
    {
        $request->validated();

        if ($request->hasFile('post_img')) {
            $filename = $request->post_img->getClientOriginalName();
            $request->post_img->move('post/', $filename);
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'post_img' => $filename,
        ];

        Post::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Post created :)',
        ]);
    }

    public function user_posts()
    {
        return PostResource::collection(Auth::user()->posts()->get());
    }

    public function show_user_post($id)
    {
        return PostResource::make(Auth::user()->posts()->findOrFail($id));
    }

    public function update_user_post(UpdatePostRequest $request, $id)
    {
        $request->validated();

        $post = Post::findOrFail($id);
        if ($request->hasFile('post_img')) {
            $filename = $request->post_img->getClientOriginalName();
            $request->post_img->move('post/', $filename);

            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'post_img' => $filename,
            ];
            $post->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Post updated successfully :)',
            ]);

        }
    }

    public function destroy_post(Post $post, $id)
    {
        $post->findOrFail($id);
        $post->destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Post deleted :D !'
        ]);
    }
}
