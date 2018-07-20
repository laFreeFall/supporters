<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Category;
use App\Color;
use App\Http\Requests\StoreCampaignRequest;

class CampaignController extends Controller
{
    /**
     * Instantiate a new CampaignController instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the campaigns.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::where('active', true)->withCount('followers', 'posts')->get();
        $categories = Category::select('id', 'title')->paginate(9);

        return view('campaigns.index', compact('campaigns', 'categories'));
    }

    /**
     * Show the form for creating a new campaign.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campaign = new Campaign();
        $categories = Category::select('id', 'title')->get();
        $colors = Color::all();

        return view('campaigns.create', compact('campaign', 'categories', 'colors'));
    }

    /**
     * Store a newly created campaign in storage.
     *
     * @param  \App\Http\Requests\StoreCampaignRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampaignRequest $request)
    {
        $avatarPath = $request->has('avatar') ? $request->file('avatar')->store('images/campaigns/previews','public') : null;

        $campaign = auth()->user()->campaigns()->create([
            'title' => $request->title,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'activity' => $request->activity,
            'description' => $request->description,
            'holder' => $request->holder === 'ocr',
            'color_id' => $request->color_id,
            'avatar' => $avatarPath,
            'active' => false
        ]);

        return redirect(route('campaigns.preview', $campaign))->with(
            'flash_body', 'Preview of the campaign has been created successfully!'
        );
    }

    /**
     * Display the specified campaign.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        $campaign->load('user.profile', 'goals.campaign', 'pledges', 'postsCount', 'followersCount');

        return view('campaigns.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified campaign.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        $categories = Category::select('id', 'title')->get();
        $colors = Color::all();

        return view('campaigns.edit', compact('campaign', 'categories', 'colors'));
    }

    /**
     * Update the specified campaign in storage.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Http\Requests\StoreCampaignRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Campaign $campaign, StoreCampaignRequest $request)
    {
        $this->authorize('update', $campaign);

        $avatarPath = $request->has('avatar') ? $request->file('avatar')->store('images/campaigns/previews','public') : null;

        $campaign->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'activity' => $request->activity,
            'description' => $request->description,
            'holder' => $request->holder === 'ocr',
            'color_id' => $request->color_id,
            'avatar' => $avatarPath,
            'active' => true
        ]);

        return redirect(route('campaigns.show', ['campaign' => $campaign]))->with(
            'flash_body', 'Campaign has been updated successfully!'
        );
    }

    /**
     * Softly remove the specified campaign from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign)
    {
        $this->authorize('delete', $campaign);

        $campaign->delete();

        return redirect('campaigns.index')->with(
            'flash_body', 'Campaign has been deleted successfully!'
        );
    }

    /**
     * Hide the specified campaign from the active ones.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function archive(Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        $campaign->active = false;
        $campaign->save();

        return redirect(route('campaigns.show', $campaign))->with(
            'flash_body', 'Campaign has been successfully archived!'
        );
    }

    /**
     * Make the specified campaign active.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function restore(Campaign $campaign)
    {
        $this->authorize('delete', $campaign);

        $campaign->active = true;
        $campaign->save();

        return redirect(route('campaigns.show', $campaign))->with(
            'flash_body', 'Campaign has been restored successfully!'
        );
    }

    /**
     * Show the preview of the specified campaign after its creating.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function preview(Campaign $campaign)
    {
        $this->authorize('preview', $campaign);

        return view('campaigns.preview', compact('campaign'));
    }
}
