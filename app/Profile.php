<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * Get the avatar path of the profile.
     *
     * @return string
     */
    public function getAvatarPathAttribute()
    {
        return asset($this->avatar ? "/storage/{$this->avatar}" : '/storage/images/avatars/no-avatar.png');
    }

    /**
     * Get the full name of the profile owner.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->first_name}";
    }

    /**
     * Get the owner of the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
