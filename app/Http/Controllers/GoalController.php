<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Goal;
use App\Http\Requests\StoreGoalRequest;

class GoalController extends Controller
{
    /**
     * Display a listing of the campaign`s goals.
     *
     * @param  Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign)
    {
        $campaign->load('goals.campaign');

        return view('campaigns.goals.index', compact('campaign'));
    }

    /**
     * Show the form for creating a new campaign`s goal.
     *
     * @param  Campaign  $campaign
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Campaign $campaign)
    {
        $this->authorize('create', $campaign);

        $goal = new Goal();

        return view('campaigns.goals.create', compact('campaign', 'goal'));
    }

    /**
     * Store a newly created campaign`s goal in storage.
     *
     * @param  Campaign  $campaign
     * @param  StoreGoalRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Campaign $campaign, StoreGoalRequest $request)
    {
        $this->authorize('create', $campaign);

        $campaign->goals()->create($request->validated());

        return redirect(route('campaigns.goals.index', ['campaign' => $campaign]));
    }

    /**
     * Show the form for editing the specified campaign`s goal.
     *
     * @param  Campaign  $campaign
     * @param  Goal  $goal
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Campaign $campaign, Goal $goal)
    {
        $this->authorize('update', $campaign);

        return view('campaigns.goals.edit', compact('campaign', 'goal'));
    }

    /**
     * Update the specified campaign`s goal in storage.
     *
     * @param  Campaign  $campaign
     * @param  Goal  $goal
     * @param  StoreGoalRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Campaign $campaign, Goal $goal, StoreGoalRequest $request)
    {
        $this->authorize('update', $campaign);

        $goal->update($request->validated());

        return redirect(route('campaigns.goals.index', ['campaign' => $campaign]));
    }

    /**
     * Remove the specified campaign`s goal from storage.
     *
     * @param  Campaign  $campaign
     * @param  Goal  $goal
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign, Goal $goal)
    {
        $this->authorize('delete', $campaign);

        $goal->delete();

        return redirect(route('campaigns.goals.index', ['campaign' => $campaign]));
    }
}
