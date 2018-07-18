<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Comment;
use App\Post;
use App\Http\Requests\StorePostRequest;
use App\PostPrivacy;

class PostController extends Controller
{
    /**
     * Display a listing of the campaign`s posts.
     *
     * @param  Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign)
    {
        $campaign->load('posts');

        return view('campaigns.posts.index', compact('campaign'));
    }

    /**
     * Show the form for creating a new campaign`s post.
     *
     * @param  Campaign  $campaign
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        $post = new Post();
        $privacies = PostPrivacy::select('id', 'title')->get();

        return view('campaigns.posts.create', compact('campaign', 'post', 'privacies'));
    }

    /**
     * Store a newly created campaign`s post in storage.
     *
     * @param  Campaign  $campaign
     * @param  StorePostRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Campaign $campaign, StorePostRequest $request)
    {
        $this->authorize('update', $campaign);

        $campaign->posts()->create($request->validated());

        return redirect(route('campaigns.posts.index', ['campaign' => $campaign]));
    }

    /**
     * Display the specified post.
     *
     * @param  Campaign  $campaign
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign, Post $post)
    {
        $post->load('comments.author.profile', 'comments.likes');
        $emptyComment = new Comment();

        return view('campaigns.posts.show', compact('campaign', 'post', 'emptyComment'));
    }

    /**
     * Show the form for editing the specified campaign`s post.
     *
     * @param  Campaign  $campaign
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Campaign $campaign, Post $post)
    {
        $this->authorize('update', $campaign);
        $privacies = PostPrivacy::select('id', 'title')->get();

        return view('campaigns.posts.edit', compact('campaign', 'post', 'privacies'));
    }

    /**
     * Update the specified campaign`s post in storage.
     *
     * @param  Campaign  $campaign
     * @param  Post  $post
     * @param  StorePostRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Campaign $campaign, Post $post, StorePostRequest $request)
    {
        $this->authorize('update', $campaign);

        $post->update($request->validated());

        return redirect(route('campaigns.posts.index', ['campaign' => $campaign]));
    }

    /**
     * Remove the specified campaign`s post from storage.
     *
     * @param  Campaign $campaign
     * @param  Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign, Post $post)
    {
        $this->authorize('update', $campaign);

        $post->delete();

        return redirect(route('campaigns.posts.index', ['campaign' => $campaign]));
    }
}
