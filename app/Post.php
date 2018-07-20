<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'campaigns_posts';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The relations that loads by default with the instance.
     *
     * @var array
     */
    protected $with = ['privacy', 'tags'];

    /**
     * Get the campaign associated with the post.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get the privacy level of the post.
     */
    public function privacy()
    {
        return $this->belongsTo(PostPrivacy::class, 'privacy_id');
    }

    /**
     * Get the comments written to the post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get all of the post's likes.
     */
    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    /**
     * Get the result is post liked by authenticated user or not.
     */
    public function isLiked()
    {
        return $this->likes->where('user_id', auth()->id())->count();
    }

    /**
     * Get the tags attached to the post.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
