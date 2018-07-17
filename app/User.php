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
     * Get the campaigns followed by user.
     */
    public function followings()
    {
        return $this->belongsToMany(Campaign::class);
    }

    /**
     * Get the result if user follows a campaign or not.
     */
    public function isFollowingCampaign($campaign)
    {
        return $this->followings->contains($campaign);
    }
}
