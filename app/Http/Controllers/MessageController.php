<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Http\Requests\StoreMessageRequest;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MessageController extends Controller
{
    /**
     * Instantiate a new CommentController instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the campaign`s posts.
     *
     * @param  \App\Campaign  $campaign
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign, Request $request)
    {
        $campaign->load('messages');
        $messages = $campaign->messages()->with('campaign', 'parent.author.profile', 'author.profile')->get();
        $grouppedMessages = $messages->map(function($message) use ($messages) {
            if($message->repliable_id) return null;
            $message->childs = $messages->where('repliable_id', $message->id)->map(function($message) {
                $message->childs = [];
                return $message;
            });
            return $message;
        })->filter(function($message) {
            return $message;
        });
        $messages = new LengthAwarePaginator($grouppedMessages, $grouppedMessages->count(), 5, $request->has('page') ? $request->page : 1);
        $emptyMessage = new Message();

        return view('campaigns.messages.index', compact('campaign', 'messages', 'emptyMessage'));
    }

    /**
     * Store a newly created campaign`s post`s comment in storage.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Campaign $campaign, StoreMessageRequest $request)
    {
        $isChild = false;
        if($request->has('repliable_id')) {
            $isChild = !Message::find($request->repliable_id)->parent_id;
        }
        $campaign->messages()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
            'repliable_id' => $request->repliable_id,
            'parent_id' => $isChild ? $request->repliable_id : null
        ]);

        return redirect(route('campaigns.messages.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Message has been created successfully!'
        );
    }

    /**
     * Show the form for editing the specified campaign`s post` comment.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Campaign $campaign, Message $message)
    {
        $this->authorize('update', $message);

        return view('campaigns.messages.edit', compact('campaign', 'message'));
    }

    /**
     * Update the specified campaign`s post`s comment in storage.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Message  $message
     * @param  \App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Campaign $campaign, Message $message, StoreMessageRequest $request)
    {
        $this->authorize('delete', $message);

        $message->update($request->validated());

        return redirect(route('campaigns.messages.index', compact('campaign')))->with(
            'flash_body', 'Message has been changed successfully!'
        );
    }

    /**
     * Remove the specified campaign`s post`s comment from storage.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign, Message $message)
    {
        $this->authorize('update', $campaign);

        $message->delete();

        return redirect(route('campaigns.messages.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Message has been deleted successfully!'
        );
    }
}
