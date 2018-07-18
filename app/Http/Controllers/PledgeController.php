<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePledgeRequest;
use App\Campaign;
use App\Pledge;

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
     * @param  Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign)
    {
        $campaign->load('pledges');

        return view('campaigns.pledges.index', compact('campaign'));
    }

    /**
     * Show the form for creating a new campaign`s pledge.
     *
     * @param  Campaign  $campaign
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
     * @param  Campaign  $campaign
     * @param  StorePledgeRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Campaign $campaign, StorePledgeRequest $request)
    {
        $this->authorize('update', $campaign);

        $campaign->pledges()->create($request->validated());

        return redirect(route('campaigns.pledges.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Goal has been successfully created'
        );
    }

    /**
     * Show the form for editing the specified campaign`s pledge.
     *
     * @param  Campaign  $campaign
     * @param  Pledge  $pledge
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
     * @param  Campaign  $campaign
     * @param  Pledge  $pledge
     * @param  StorePledgeRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Campaign $campaign, Pledge $pledge, StorePledgeRequest $request)
    {
        $this->authorize('update', $campaign);

        $pledge->update($request->validated());

        return redirect(route('campaigns.pledges.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Goal has been successfully updated'
        );
    }

    /**
     * Remove the specified campaign`s pledge from storage.
     *
     * @param  Campaign  $campaign
     * @param  Pledge  $pledge
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign, Pledge $pledge)
    {
        $this->authorize('update', $campaign);

        $pledge->delete();

        return redirect(route('campaigns.pledges.index', ['campaign' => $campaign]))->with(
            'flash_body', 'Goal has been successfully deleted'
        );
    }
}
