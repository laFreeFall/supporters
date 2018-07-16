<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\CampaignCategory;
use App\CampaignColor;
use App\Http\Requests\StoreCampaignRequest;
use Illuminate\Http\Request;

class CampaignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::all();
        $categories = CampaignCategory::select('id', 'title')->paginate(12);

        return view('campaign.index', compact('campaigns', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campaign = new Campaign();
        $categories = CampaignCategory::select('id', 'title')->get();
        $colors = CampaignColor::all();

        return view('campaign.create', compact('campaign', 'categories', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCampaignRequest $request
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

        return redirect(route('campaign.preview', $campaign));
//        return view('campaign.preview', compact('campaign'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        $campaign->load('user', 'goals.campaign');

        return view('campaign.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        $categories = CampaignCategory::select('id', 'title')->get();
        $colors = CampaignColor::all();

        return view('campaign.edit', compact('campaign', 'categories', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCampaignRequest $request
     * @param  \App\Campaign $campaign
     * @return void
     */
    public function update(StoreCampaignRequest $request, Campaign $campaign)
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
    }

    /**
     * Softly remove the specified resource from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        //
    }

    public function archive(Campaign $campaign)
    {
        $campaign->active = false;
        $campaign->save();

        return redirect(route('campaign.show', $campaign));
    }

    /**
     * Restores the specified resource from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function restore(Campaign $campaign)
    {
        $campaign->active = true;
        $campaign->save();

        return redirect(route('campaign.show', $campaign));
    }

    public function preview(Campaign $campaign)
    {
        return view('campaign.preview', compact('campaign'));
    }
}
