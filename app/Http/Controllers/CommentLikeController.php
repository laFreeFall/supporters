<?php

namespace App\Http\Controllers;

use App\Comment;

class CommentLikeController extends Controller
{
    /**
     * Instantiate a new CommentLikeController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created comment like in storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Comment $comment)
    {
        $this->authorize('like', $comment);

        $comment->likes()->create([
            'user_id' => auth()->id()
        ]);

        return response([
            'amount' => $comment->likes()->count(),
            'value' => true,
            'flash' => 'User has liked the comment successfully!'
        ], 200);
    }

    /**
     * Remove the specified comment like from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('unlike', $comment);

        $comment->likes->firstWhere('user_id', auth()->id())->delete();

        return response([
            'amount' => $comment->likes()->count(),
            'value' => false,
            'flash' => 'User has taken his like back successfully!'
        ], 200);
    }
}
