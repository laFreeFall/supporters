<?php

namespace App\Http\Controllers;

use App\Post;

class PostLikeController extends Controller
{
    /**
     * Instantiate a new PostLikeController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            'flash' => 'User has liked the post successfully!'
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
            'flash' => 'User has taken his like back successfully!'
        ], 200);
    }
}
