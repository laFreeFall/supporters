<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Comment;
use App\Post;
use App\PostPrivacy;
use App\Tag;
use App\Http\Requests\StorePostRequest;
use App\Filters\PostFilters;

class PostController extends Controller
{
    /**
     * Instantiate a new PostController instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the campaign`s posts.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Filters\PostFilters  $filters
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign, PostFilters $filters)
    {
        $posts = Post::latest()
            ->where('campaign_id', $campaign->id)
            ->filter($filters)
            ->with('campaign', 'pledge', 'likes', 'privacy', 'tags')
            ->withCount('comments')
            ->paginate(10);

        $emptyTag = new Tag();

        return view('campaigns.posts.index', compact('campaign', 'posts', 'emptyTag'));
    }

    /**
     * Show the form for creating a new campaign`s post.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        $post = new Post();
        $pledges = $campaign->pledges;

        $privacies = PostPrivacy::all();
        if(! $pledges->count()) {
            $privacies = $privacies->filter(function($privacy) {
                return $privacy->value !== 'supporters';
            });
        }

        $tags = Tag::select('id', 'name')->get();

        return view('campaigns.posts.create', compact('campaign', 'post', 'privacies', 'pledges', 'tags'));
    }

    /**
     * Store a newly created campaign`s post in storage.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Campaign $campaign, StorePostRequest $request)
    {
        $this->authorize('update', $campaign);

        $post = $campaign->posts()->create([
            'user_id' => auth()->id(),
            'privacy_id' => $request->privacy_id,
            'pledge_id' => $request->pledge_id,
            'title' => $request->title,
            'body' => $request->body
        ]);

        $post->tags()->attach($request->tags);

        return redirect(route('campaigns.posts.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Post has been created successfully!'
        );
    }

    /**
     * Display the specified post.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign, Post $post)
    {
        $post->load('campaign', 'pledge', 'likes', 'privacy', 'tags');
        $comments = $post->comments()
            ->with('author.profile', 'likes')
            ->latest()
            ->paginate(10);

        $emptyComment = new Comment();

        return view('campaigns.posts.show', compact('campaign', 'post', 'comments', 'emptyComment'));
    }

    /**
     * Show the form for editing the specified campaign`s post.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Campaign $campaign, Post $post)
    {
        $this->authorize('update', $campaign);

        $privacies = PostPrivacy::all();
        $pledges = $campaign->pledges;
        $tags = Tag::select('id', 'name')->get();

        return view('campaigns.posts.edit', compact('campaign', 'post', 'privacies', 'pledges', 'tags'));
    }

    /**
     * Update the specified campaign`s post in storage.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Post  $post
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Campaign $campaign, Post $post, StorePostRequest $request)
    {
        $this->authorize('update', $campaign);

        $post->update([
            'privacy_id' => $request->privacy_id,
            'pledge_id' => $request->pledge_id,
            'title' => $request->title,
            'body' => $request->body
        ]);

        $post->tags()->sync($request->tags);

        return redirect(route('campaigns.posts.show', ['campaign' => $campaign, 'post' => $post]))->with(
            'flash_body', 'Post has been changed successfully!'
        );
    }

    /**
     * Remove the specified campaign`s post from storage.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign, Post $post)
    {
        $this->authorize('update', $campaign);

        $post->delete();

        return redirect(route('campaigns.posts.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Post has been deleted successfully!'
        );
    }
}
