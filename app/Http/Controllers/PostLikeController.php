<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    /**
     * Store a newly created post like in storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Post $post)
    {
        $this->authorize('like', $post);

        $post->likes()->create([
            'user_id' => auth()->id()
        ]);

        return response([
            'amount' => $post->likes()->count(),
            'value' => true,
            'flash' => 'User successfully liked the post'
        ], 200);
    }

    /**
     * Remove the specified post like from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $this->authorize('unlike', $post);

        $post->likes->firstWhere('user_id', auth()->id())->delete();

        return response([
            'amount' => $post->likes()->count(),
            'value' => false,
            'flash' => 'User successfully unliked the post'
        ], 200);
    }
}
