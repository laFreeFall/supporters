<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function view(User $user, Post $post)
    {
        switch($post->privacy->value) {
            case 'all':
                return true;
                break;
            case 'followers':
                return $user->isFollowingCampaign($post->campaign);
                break;
            case 'supporters':
                return $user->supportAmount($post->campaign) >= $post->pledge->amount;
                break;
            default:
                return false;
        }
        // check for existing of a record in a followings table for value === 'followers'
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can like the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function like(User $user, Post $post)
    {
        return !$post->likes()->where('user_id', $user->id)->exists();
    }

    /**
     * Determine whether the user can unlike the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function unlike(User $user, Post $post)
    {
        return $post->likes()->where('user_id', $user->id)->exists();
    }
}
