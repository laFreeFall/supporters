<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\CampaignGoal;
use App\Http\Requests\StoreCampaignGoalRequest;
use Illuminate\Http\Request;

class CampaignsGoalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign)
    {
        $campaign->load('goals.campaign');

        return view('campaign.goal.index', compact('campaign'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function create(Campaign $campaign)
    {
        $goal = new CampaignGoal();

        return view('campaign.goal.create', compact('campaign', 'goal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Campaign $campaign
     * @param  StoreCampaignGoalRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Campaign $campaign, StoreCampaignGoalRequest $request)
    {
        $campaign->goals()->create($request->validated());

        return redirect(route('campaign.goal.index', ['campaign' => $campaign]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Campaign $campaign
     * @param  CampaignGoal $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign, CampaignGoal $goal)
    {
        return view('campaign.goal.edit', compact('campaign', 'goal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Campaign $campaign
     * @param  CampaignGoal $goal
     * @param  StoreCampaignGoalRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Campaign $campaign, CampaignGoal $goal, StoreCampaignGoalRequest $request)
    {
        $goal->update($request->validated());

        return redirect(route('campaign.goal.index', ['campaign' => $campaign]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Campaign $campaign
     * @param  CampaignGoal $goal
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign, CampaignGoal $goal)
    {
        $goal->delete();

        return redirect(route('campaign.goal.index', ['campaign' => $campaign]));
    }
}
