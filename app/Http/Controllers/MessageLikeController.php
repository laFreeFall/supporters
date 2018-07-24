<?php

namespace App\Http\Controllers;

use App\Message;

class MessageLikeController extends Controller
{
    /**
     * Instantiate a new MessageLikeController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created comment like in storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Message $message)
    {
        $this->authorize('like', $message);

        $message->likes()->create([
            'user_id' => auth()->id()
        ]);

        return response([
            'amount' => $message->likes()->count(),
            'value' => true,
            'flash' => 'User has liked the comment successfully!'
        ], 200);
    }

    /**
     * Remove the specified comment like from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Message $message)
    {
        $this->authorize('unlike', $message);

        $message->likes->firstWhere('user_id', auth()->id())->delete();

        return response([
            'amount' => $message->likes()->count(),
            'value' => false,
            'flash' => 'User has taken his like back successfully!'
        ], 200);
    }
}
