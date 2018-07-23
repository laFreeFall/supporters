<?php

namespace App\Http\Controllers;

use App\Pledge;
use App\Support;

class SupportController extends Controller
{
    /**
     * Instantiate a new SupportController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created support record in storage.
     *
     * @param  \App\Pledge  $pledge
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Pledge $pledge)
    {
        $this->authorize('support', $pledge->campaign);

        $campaignsPledgesIds = $pledge->campaign->pledges->pluck('id');
        if(auth()->user()->supports->whereIn('id', $campaignsPledgesIds)->count()) {
            auth()->user()->supports->whereIn('id', $campaignsPledgesIds)->first()->update([
                'pledge_id' => $pledge->id
            ]);
        } else {
            $pledge->supports()->create([
                'user_id' => auth()->id()
            ]);
        }

        return redirect(route('campaigns.show', ['campaign' => $pledge->campaign]))->with([
            'flash_body' => 'User has supported the campaign for $' . $pledge->amount . ' successfully!'
        ]);
    }
}
