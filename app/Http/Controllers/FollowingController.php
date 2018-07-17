<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\User;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    /**
     * Store a newly created following relationship in storage.
     *
     * @param  \App\Campaign  $campaign
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(Campaign $campaign, User $user)
    {
        $campaign->followers()->attach($user);

        return response('User has been followed the campaign', 200);
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
        $campaign->followers()->detach($user);

        return response('User has been unfollowed the campaign', 200);
    }
}
