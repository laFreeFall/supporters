<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Category;
use App\Color;
use App\Http\Requests\StoreCampaignRequest;

class CampaignController extends Controller
{
    /**
     * Display a listing of the campaigns.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::all();
        $categories = Category::select('id', 'title')->paginate(12);

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
     * @param  StoreCampaignRequest $request
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

        return redirect(route('campaigns.preview', $campaign));
    }

    /**
     * Display the specified campaign.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        $campaign->load('user', 'goals.campaign', 'pledges');

        return view('campaigns.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified campaign.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        $categories = Category::select('id', 'title')->get();
        $colors = Color::all();

        return view('campaigns.edit', compact('campaign', 'categories', 'colors'));
    }

    /**
     * Update the specified campaign in storage.
     *
     * @param  \App\Campaign $campaign
     * @param  StoreCampaignRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Campaign $campaign, StoreCampaignRequest $request)
    {
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

        return redirect(route('campaigns.show', ['campaign' => $campaign]));
    }

    /**
     * Softly remove the specified campaign from storage.
     *
     * @param  \App\Campaign $campaign
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return redirect('campaigns.index');
    }

    /**
     * Hide the specified campaign from the active ones.
     *
     * @param  \App\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function archive(Campaign $campaign)
    {
        $campaign->active = false;
        $campaign->save();

        return redirect(route('campaigns.show', $campaign));
    }

    /**
     * Make the specified campaign active.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function restore(Campaign $campaign)
    {
        $campaign->active = true;
        $campaign->save();

        return redirect(route('campaigns.show', $campaign));
    }

    /**
     * Show the preview of the specified campaign after its creating.
     *
     * @param  \App\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function preview(Campaign $campaign)
    {
        return view('campaigns.preview', compact('campaign'));
    }
}
