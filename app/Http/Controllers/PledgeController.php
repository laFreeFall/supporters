<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Pledge;
use App\Http\Requests\StorePledgeRequest;

class PledgeController extends Controller
{
    /**
     * Instantiate a new PledgeController instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the campaign`s pledges.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign)
    {
        $campaign->load('pledges');
        $supportAmount = auth()->check() ? auth()->user()->supportAmount($campaign) : 0;

        return view('campaigns.pledges.index', compact('campaign', 'supportAmount'));
    }

    /**
     * Show the form for creating a new campaign`s pledge.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        $pledge = new Pledge();

        return view('campaigns.pledges.create', compact('campaign', 'pledge'));
    }

    /**
     * Store a newly created campaign`s pledge in storage.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Http\Requests\StorePledgeRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Campaign $campaign, StorePledgeRequest $request)
    {
        $this->authorize('update', $campaign);

        $campaign->pledges()->create($request->validated());

        return redirect(route('campaigns.pledges.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Goal has been created successfully!'
        );
    }

    /**
     * Show the form for editing the specified campaign`s pledge.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Pledge  $pledge
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Campaign $campaign, Pledge $pledge)
    {
        $this->authorize('update', $campaign);

        return view('campaigns.pledges.edit', compact('campaign', 'pledge'));
    }

    /**
     * Update the specified campaign`s pledge in storage.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Pledge  $pledge
     * @param  \App\Http\Requests\StorePledgeRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Campaign $campaign, Pledge $pledge, StorePledgeRequest $request)
    {
        $this->authorize('update', $campaign);

        $pledge->update($request->validated());

        return redirect(route('campaigns.pledges.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Goal has been updated successfully!'
        );
    }

    /**
     * Remove the specified campaign`s pledge from storage.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\Pledge  $pledge
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign, Pledge $pledge)
    {
        $this->authorize('update', $campaign);

        $pledge->delete();

        return redirect(route('campaigns.pledges.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Goal has been deleted successfully!'
        );
    }
}
