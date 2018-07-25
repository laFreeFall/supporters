<?php

namespace App\Http\Controllers;

use \App\Campaign;
use App\Follow;
use \App\User;

class CampaignFollowController extends Controller
{
    /**
     * Instantiate a new CampaignFollowController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created following relationship in storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Campaign $campaign)
    {
        $this->authorize('follow', $campaign);

//        $campaign->followers()->attach(auth()->user());
//        We have to use direct Follow::create()
//        Because when using attach() it doesn't trigger pivot events like create
//        https://laracasts.com/discuss/channels/eloquent/eloquent-attach-which-event-is-fired/replies/374914
        Follow::create([
            'campaign_id' => $campaign->id,
            'user_id' => auth()->id()
        ]);

        return response([
            'value' => true,
            'flash' => 'User has followed the campaign successfully!'
        ], 200);
    }

    /**
     * Remove the specified following relationship from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Campaign $campaign)
    {
        $this->authorize('unfollow', $campaign);

//        $campaign->followers()->detach(auth()->user());
//        We have to use direct Follow::delete()
//        Because when using attach() it doesn't trigger pivot events like create
//        https://laracasts.com/discuss/channels/eloquent/eloquent-attach-which-event-is-fired/replies/374914
        Follow::where([
                'campaign_id' => $campaign->id,
                'user_id' => auth()->id()
            ])
            ->first()
            ->delete();

        return response([
            'value' => false,
            'flash' => 'User has unfollowed the campaign successfully!'
        ], 200);
    }
}
