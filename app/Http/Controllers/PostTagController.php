<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    /**
     * Store a record of attaching tag to the post in storage.
     *
     * @param  Campaign  $campaign
     * @param  Post  $post
     * @param  Tag  $tag
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Campaign $campaign, Post $post, Tag $tag)
    {
        $this->authorize('update', $post);

        $post->tags()->attach($tag);

        return redirect(route('campaigns.posts.show', ['campaign' => $campaign, 'post' => $post]))->with(
            'flash_body', 'Tag successfully attached'
        );
    }

    /**
     * Remove the record of linked tag and post from storage.
     *
     * @param  Campaign  $campaign
     * @param  Post  $post
     * @param  Tag  $tag
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign, Post $post, Tag $tag)
    {
        $this->authorize('update', $post);

        $post->tags()->detach($tag);

        return redirect(route('campaigns.posts.show', ['campaign' => $campaign, 'post' => $post]))->with(
            'flash_body', 'Tag successfully detached'
        );
    }
}
