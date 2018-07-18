<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return bool
     */
    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return bool
     */
    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }

    /**
     * Determine whether the user can like the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return bool
     */
    public function like(User $user, Comment $comment)
    {
        return !$comment->likes()->where('user_id', $user->id)->exists();
    }

    /**
     * Determine whether the user can unlike the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return bool
     */
    public function unlike(User $user, Comment $comment)
    {
        return $comment->likes()->where('user_id', $user->id)->exists();
    }
}
