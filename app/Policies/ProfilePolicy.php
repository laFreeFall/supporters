<?php

namespace App\Policies;

use App\User;
use App\Profile;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create profiles.
     *
     * @param  \App\User  $user
     * @return boolean
     */
    public function create(User $user)
    {
        return $user->profile === null;
    }

    /**
     * Determine whether the user can update the profile.
     *
     * @param  \App\User  $user
     * @param  \App\Profile  $profile
     * @return boolean
     */
    public function update(User $user, Profile $profile)
    {
        return $user->id === $profile->user_id;
    }

    /**
     * Determine whether the user can delete the profile.
     *
     * @param  \App\User  $user
     * @param  \App\Profile  $profile
     * @return boolean
     */
    public function delete(User $user, Profile $profile)
    {
        return $user->id === $profile->user_id;
    }
}
