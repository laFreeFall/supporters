<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Comment;
use App\Post;
use App\Http\Requests\StorePostRequest;
use App\PostPrivacy;
use App\Tag;
use App\Filters\PostFilters;

class PostController extends Controller
{
    /**
     * Display a listing of the campaign`s posts.
     *
     * @param  Campaign $campaign
     * @param  PostFilters $filters
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign, PostFilters $filters)
    {
        $posts = Post::where('campaign_id', $campaign->id)
            ->filter($filters)
            ->with('likes')
            ->withCount('comments')
            ->get();

        $emptyTag = new Tag();

        return view('campaigns.posts.index', compact('campaign', 'posts', 'emptyTag'));
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
        $tags = Tag::select('id', 'name')->get();

        return view('campaigns.posts.create', compact('campaign', 'post', 'privacies', 'tags'));
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

        $post = $campaign->posts()->create([
            'user_id' => auth()->id(),
            'privacy_id' => $request->privacy_id,
            'title' => $request->title,
            'body' => $request->body
        ]);

        $post->tags()->attach($request->tags);

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
        $tags = Tag::select('id', 'name')->get();

        return view('campaigns.posts.edit', compact('campaign', 'post', 'privacies', 'tags'));
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

        $post->update([
            'privacy_id' => $request->privacy_id,
            'title' => $request->title,
            'body' => $request->body
        ]);

        $post->tags()->sync($request->tags);

        return redirect(route('campaigns.posts.show', ['campaign' => $campaign, 'post' => $post]));
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
