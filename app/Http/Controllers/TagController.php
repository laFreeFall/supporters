<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Tag;
use App\Http\Requests\StoreTagRequest;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Store a newly created campaign`s tag in storage.
     *
     * @param  Campaign  $campaign
     * @param  StoreTagRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Campaign $campaign, StoreTagRequest $request)
    {
        $this->authorize('update', $campaign);

        $campaign->tags()->create($request->validated());

        return redirect(route('campaigns.posts.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Tag successfully created'
        );
    }

    /**
     * Remove the specified campaign`s tag from storage.
     *
     * @param  Campaign  $campaign
     * @param  Tag  $tag
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign, Tag $tag)
    {
        $this->authorize('update', $campaign);

        $tag->delete();

        return redirect(route('campaigns.posts.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Tag successfully deleted'
        );
    }
}
