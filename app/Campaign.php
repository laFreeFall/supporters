<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $with = ['category', 'colors'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(CampaignCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function colors()
    {
        return $this->belongsTo(CampaignColor::class, 'color_id');
    }

    public function goals()
    {
        return $this->hasMany(CampaignGoal::class)->orderBy('amount');
    }

    public function pledges()
    {
        return $this->hasMany(CampaignPledge::class)->orderBy('amount');
    }

    public function getAvatarPathAttribute()
    {
        return asset($this->avatar ? '/storage/' . $this->avatar : '/storage/' . 'images/avatars/no-avatar.png');
    }
}
