<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAvatarPathAttribute()
    {
        return asset($this->avatar ? '/storage/' . $this->avatar : '/storage/' . 'images/avatars/no-avatar.png');
    }

    public function getFullNameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name;
    }
}
