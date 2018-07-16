<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignGoal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'campaigns_goals';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $appends = ['progress'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function getProgressAttribute()
    {
        return $this->campaign->earnings > $this->amount ? 100 : $this->campaign->earnings / $this->amount * 100;
    }

}
