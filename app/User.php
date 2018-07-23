<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The relations that loads by default with the instance.
     *
     * @var array
     */
    protected $with = ['profile'];

    /**
     * Get the user profile.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Get the campaigns that user has run.
     */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    /**
     * Get count of the campaigns run by the user.
     */
    public function campaignsCount()
    {
        return $this->hasOne(Campaign::class)
            ->selectRaw('user_id, count(*) as count')
            ->groupBy('user_id');
    }

    /**
     * Get count of the campaigns run by the user.
     *
     * @return int
     */
    public function getCampaignsCountAttribute()
    {
        if ( ! array_key_exists('campaignsCount', $this->relations))
            $this->load('campaignsCount');

        $related = $this->getRelation('campaignsCount');

        return ($related) ? (int) $related->count : 0;
    }

    /**
     * Get the campaigns followed by user.
     */
    public function follows()
    {
        return $this->belongsToMany(Campaign::class);
    }

    /**
     * Get count of the campaigns followed by the user.
     */
    public function followsCount()
    {
        return $this->hasOne(Follow::class)
            ->selectRaw('user_id, count(*) as count')
            ->groupBy('user_id');
    }

    /**
     * Get count of the campaigns followed by the user.
     *
     * @return int
     */
    public function getFollowsCountAttribute()
    {
        if ( ! array_key_exists('followsCount', $this->relations))
            $this->load('followsCount');

        $related = $this->getRelation('followsCount');

        return ($related) ? (int) $related->count : 0;
    }

    /**
     * Get the result if user follows a campaign or not.
     *
     * @param  $campaign
     * @return bool
     */
    public function isFollowingCampaign($campaign)
    {
        return $this->follows->contains($campaign);
    }

    /**
     * Get the campaigns posts created by user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get count of the campaigns posts created by the user.
     */
    public function postsCount()
    {
        return $this->hasOne(Post::class)
            ->selectRaw('user_id, count(*) as count')
            ->groupBy('user_id');
    }

    /**
     * Get count of the campaigns posts created  by the user.
     *
     * @return int
     */
    public function getPostsCountAttribute()
    {
        if ( ! array_key_exists('postsCount', $this->relations))
            $this->load('postsCount');

        $related = $this->getRelation('postsCount');

        return ($related) ? (int) $related->count : 0;
    }

    /**
     * Get the comments to the campaigns posts written by user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get count of the comments to the campaigns posts written by the user.
     */
    public function commentsCount()
    {
        return $this->hasOne(Comment::class)
            ->selectRaw('user_id, count(*) as count')
            ->groupBy('user_id');
    }

    /**
     * Get count of the comments to the campaigns posts written by the user.
     *
     * @return int
     */
    public function getCommentsCountAttribute()
    {
        if ( ! array_key_exists('commentsCount', $this->relations))
            $this->load('commentsCount');

        $related = $this->getRelation('commentsCount');

        return ($related) ? (int) $related->count : 0;
    }

    /**
     * Get count of the liked campaigns posts and comments to the posts by the user.
     */
    public function likesCount()
    {
        return $this->hasOne(Like::class)
            ->selectRaw('user_id, count(*) as count')
            ->groupBy('user_id');
    }

    /**
     * Get count of the liked campaigns posts and comments to the posts by the user.
     *
     * @return int
     */
    public function getLikesCountAttribute()
    {
        if ( ! array_key_exists('likesCount', $this->relations))
            $this->load('likesCount');

        $related = $this->getRelation('likesCount');

        return ($related) ? (int) $related->count : 0;
    }

    /**
     * Get the activities records related to the user.
     */
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
