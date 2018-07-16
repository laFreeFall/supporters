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

    /**
     * The relations that loads by default with the instance.
     *
     * @var array
     */
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

    /**
     * Get the avatar path of the campaign.
     *
     * @return string
     */
    public function getAvatarPathAttribute()
    {
        return asset($this->avatar ? '/storage/' . $this->avatar : '/storage/' . 'images/avatars/no-avatar.png');
    }

    /**
     * Get the category of the campaign.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the user who has run the campaign.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the colors associated with the campaign.
     */
    public function colors()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    /**
     * Get the goals associated with the campaign.
     */
    public function goals()
    {
        return $this->hasMany(Goal::class)->orderBy('amount');
    }

    /**
     * Get the pledges associated with the campaign.
     */
    public function pledges()
    {
        return $this->hasMany(Pledge::class)->orderBy('amount');
    }
}
