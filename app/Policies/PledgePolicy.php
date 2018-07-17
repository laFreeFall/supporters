<?php

namespace App\Policies;

use App\Campaign;
use App\User;
use App\Pledge;
use Illuminate\Auth\Access\HandlesAuthorization;

class PledgePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create pledges.
     *
     * @param  \App\User  $user
     * @param  \App\Campaign  $campaign
     * @return boolean
     */
    public function create(User $user, Campaign $campaign)
    {
        return $user->id === $campaign->user_id;
    }

    /**
     * Determine whether the user can update the pledge.
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
     * Determine whether the user can delete the pledge.
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
