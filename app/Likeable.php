<?php

namespace App;

trait Likeable
{
    /**
     * Get all of the post's likes.
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Get the result is comment liked by authenticated user or not.
     * @param  mixed $id
     * @return bool
     */
    public function isLiked($id = null)
    {
        $id = $id ?? auth()->id();
        return !! $this->likes->where('user_id', $id)->count();
    }
}