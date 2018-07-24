<?php

namespace App\Policies;

use App\Message;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Message  $message
     * @return bool
     */
    public function update(User $user, Message $message)
    {
        return $user->id === $message->user_id || $user->id === $message->campaign->user_id;
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Message  $message
     * @return bool
     */
    public function delete(User $user, Message $message)
    {
        return $user->id === $message->user_id || $user->id === $message->campaign->user_id;
    }

    /**
     * Determine whether the user can like the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Message  $message
     * @return bool
     */
    public function like(User $user, Message $message)
    {
        return !$message->likes->where('user_id', $user->id)->count() > 0;
    }

    /**
     * Determine whether the user can unlike the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Message  $message
     * @return bool
     */
    public function unlike(User $user, Message $message)
    {
        return $message->likes->where('user_id', $user->id)->count() > 0;
    }
}
