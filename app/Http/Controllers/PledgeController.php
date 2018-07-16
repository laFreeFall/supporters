<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePledgeRequest;
use App\Campaign;
use App\Pledge;

class PledgeController extends Controller
{
    /**
     * Display a listing of the campaign`s pledges.
     *
     * @param  Campaign $campaign
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
     * @param  Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function create(Campaign $campaign)
    {
        $pledge = new Pledge();

        return view('campaigns.pledges.create', compact('campaign', 'pledge'));
    }

    /**
     * Store a newly created campaign`s pledge in storage.
     *
     * @param  Campaign $campaign
     * @param  StorePledgeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Campaign $campaign, StorePledgeRequest $request)
    {
        $campaign->pledges()->create($request->validated());

        return redirect(route('campaigns.pledges.index', ['campaign' => $campaign]));
    }

    /**
     * Show the form for editing the specified campaign`s pledge.
     *
     * @param  Campaign $campaign
     * @param  Pledge $pledge
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign, Pledge $pledge)
    {
        return view('campaigns.pledges.edit', compact('campaign', 'pledge'));
    }

    /**
     * Update the specified campaign`s pledge in storage.
     *
     * @param  Campaign $campaign
     * @param  Pledge $pledge
     * @param  StorePledgeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Campaign $campaign, Pledge $pledge, StorePledgeRequest $request)
    {
        $pledge->update($request->validated());

        return redirect(route('campaigns.pledges.index', ['campaign' => $campaign]));
    }

    /**
     * Remove the specified campaign`s pledge from storage.
     *
     * @param  Campaign $campaign
     * @param  Pledge $pledge
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign, Pledge $pledge)
    {
        $pledge->delete();

        return redirect(route('campaigns.pledges.index', ['campaign' => $campaign]));
    }
}
