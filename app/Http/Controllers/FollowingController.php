<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\User;

class FollowingController extends Controller
{
    /**
     * Instantiate a new FollowingController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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

        return response([
            'value' => true,
            'flash' => 'User has followed the campaign successfully!'
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
        $campaign->followers()->detach($user);

        return response([
            'value' => false,
            'flash' => 'User has unfollowed the campaign successfully!'
        ], 200);
    }
}
