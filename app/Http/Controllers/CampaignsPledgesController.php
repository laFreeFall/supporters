<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampaignPledgeRequest;
use Illuminate\Http\Request;
use App\Campaign;
use App\CampaignPledge;

class CampaignsPledgesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign)
    {
        $campaign->load('pledges');

        return view('campaign.pledge.index', compact('campaign'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function create(Campaign $campaign)
    {
        $pledge = new CampaignPledge();

        return view('campaign.pledge.create', compact('campaign', 'pledge'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Campaign $campaign
     * @param  StoreCampaignPledgeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Campaign $campaign, StoreCampaignPledgeRequest $request)
    {
        $campaign->pledges()->create($request->validated());

        return redirect(route('campaign.pledge.index', ['campaign' => $campaign]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Campaign $campaign
     * @param  CampaignPledge $pledge
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign, CampaignPledge $pledge)
    {
        return view('campaign.pledge.edit', compact('campaign', 'pledge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Campaign $campaign
     * @param  CampaignPledge $pledge
     * @param  StoreCampaignPledgeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Campaign $campaign, CampaignPledge $pledge, StoreCampaignPledgeRequest $request)
    {
        $pledge->update($request->validated());

        return redirect(route('campaign.pledge.index', ['campaign' => $campaign]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Campaign $campaign
     * @param  CampaignPledge $pledge
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign, CampaignPledge $pledge)
    {
        $pledge->delete();

        return redirect(route('campaign.pledge.index', ['campaign' => $campaign]));
    }
}
