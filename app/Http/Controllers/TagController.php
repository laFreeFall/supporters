<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Tag;
use App\Http\Requests\StoreTagRequest;

class TagController extends Controller
{
    /**
     * Instantiate a new TagController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created campaign`s tag in storage.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Http\Requests\StoreTagRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Campaign $campaign, StoreTagRequest $request)
    {
        $this->authorize('update', $campaign);

        $campaign->tags()->create($request->validated());

        return redirect(route('campaigns.posts.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Tag has been created successfully!'
        );
    }

    /**
     * Remove the specified campaign`s tag from storage.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign, Tag $tag)
    {
        $this->authorize('update', $campaign);

        $tag->delete();

        return redirect(route('campaigns.posts.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Tag has been deleted successfully!'
        );
    }
}
