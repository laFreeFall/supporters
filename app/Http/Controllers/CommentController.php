<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Post;
use App\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created campaign`s post`s comment in storage.
     *
     * @param  Campaign  $campaign
     * @param  Post  $post
     * @param  StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Campaign $campaign, Post $post, StoreCommentRequest $request)
    {
        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => $request->body
        ]);

        return redirect(route('campaigns.posts.show', ['campaign' => $campaign, 'post' => $post]));
    }

    /**
     * Show the form for editing the specified campaign`s post` comment.
     *
     * @param  Campaign  $campaign
     * @param  Post  $post
     * @param  Comment  $comment
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Campaign $campaign, Post $post, Comment $comment)
    {
        $this->authorize('update', $comment);

        return view('campaigns.posts.comments.edit', compact('campaign', 'post', 'comment'));
    }

    /**
     * Update the specified campaign`s post`s comment in storage.
     *
     * @param  Campaign  $campaign
     * @param  Post  $post
     * @param  Comment  $comment
     * @param  StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Campaign $campaign, Post $post, Comment $comment, StoreCommentRequest $request)
    {
        $this->authorize('update', $comment);

        $comment->update($request->validated());

        return redirect(route('campaigns.posts.show', ['campaign' => $campaign, 'post' => $post]))->with(
            'flash_body', 'Comment has been successfully created'
        );;
    }

    /**
     * Remove the specified campaign`s post`s comment from storage.
     *
     * @param  Campaign  $campaign
     * @param  Post  $post
     * @param  Comment $comment
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign, Post $post, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect(route('campaigns.posts.show', ['campaign' => $campaign, 'post' => $post]))->with(
            'flash_body', 'Comment has been successfully deleted'
        );;
    }
}
