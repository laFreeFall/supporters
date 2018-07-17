<?php

namespace App\Policies;

use App\User;
use App\Campaign;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampaignPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can preview the campaign after its creating.
     *
     * @param  \App\User  $user
     * @param  \App\Campaign  $campaign
     * @return boolean
     */
    public function preview(User $user, Campaign $campaign)
    {
        return $user->id === $campaign->user_id;
    }

    /**
     * Determine whether the user can update the campaign.
     *
     * @param  \App\User  $user
     * @param  \App\Campaign  $campaign
     * @return boolean
     */
    public function update(User $user, Campaign $campaign)
    {
        return $user->id === $campaign->user_id;
    }

    /**
     * Determine whether the user can delete the campaign.
     *
     * @param  \App\User  $user
     * @param  \App\Campaign  $campaign
     * @return boolean
     */
    public function delete(User $user, Campaign $campaign)
    {
        return $user->id === $campaign->user_id;
    }
}
