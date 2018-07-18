<?php

namespace App\Http\Controllers;

use \App\Campaign;
use \App\User;
use Illuminate\Http\Request;

class CampaignFollowController extends Controller
{
    /**
     * Store a newly created following relationship in storage.
     *
     * @param  \App\Campaign $campaign
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Campaign $campaign, User $user)
    {
        $this->authorize('follow', $campaign);

        $campaign->followers()->attach($user);

        return response([
            'value' => true,
            'flash' => 'User successfully followed the campaign'
        ], 200);
    }

    /**
     * Remove the specified following relationship from storage.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign, User $user)
    {
        $this->authorize('unfollow', $campaign);

        $campaign->followers()->detach($user);

        return response([
            'value' => false,
            'flash' => 'User successfully unfollowed the campaign'
        ], 200);
    }
}
