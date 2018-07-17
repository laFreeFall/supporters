<?php

namespace App\Policies;

use App\User;
use App\Campaign;
use Illuminate\Auth\Access\HandlesAuthorization;

class GoalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create goals.
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
     * Determine whether the user can update the goal.
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
     * Determine whether the user can delete the goal.
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
