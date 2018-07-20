<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Goal;
use App\Http\Requests\StoreGoalRequest;

class GoalController extends Controller
{
    /**
     * Instantiate a new GoalController instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the campaign`s goals.
     *
     * @param  \App\Campaign  $campaign
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
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        $goal = new Goal();

        return view('campaigns.goals.create', compact('campaign', 'goal'));
    }

    /**
     * Store a newly created campaign`s goal in storage.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Http\Requests\StoreGoalRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Campaign $campaign, StoreGoalRequest $request)
    {
        $this->authorize('update', $campaign);

        $campaign->goals()->create($request->validated());

        return redirect(route('campaigns.goals.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Pledge has been created successfully!'
        );
    }

    /**
     * Show the form for editing the specified campaign`s goal.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Goal  $goal
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
     * @param  \App\Campaign  $campaign
     * @param  \App\Goal  $goal
     * @param  \App\Http\Requests\StoreGoalRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Campaign $campaign, Goal $goal, StoreGoalRequest $request)
    {
        $this->authorize('update', $campaign);

        $goal->update($request->validated());

        return redirect(route('campaigns.goals.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Pledge has been updated successfully!'
        );
    }

    /**
     * Remove the specified campaign`s goal from storage.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign, Goal $goal)
    {
        $this->authorize('update', $campaign);

        $goal->delete();

        return redirect(route('campaigns.goals.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Pledge has been deleted successfully!'
        );
    }
}
