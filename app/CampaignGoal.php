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

    /**
     * The accessors that always loads as any other DB field.
     *
     * @var array
     */
    protected $appends = ['progress'];

    /**
     * Get the progress percent of the goal.
     *
     * @return integer
     */
    public function getProgressAttribute()
    {
        return $this->campaign->earnings > $this->amount ? 100 : $this->campaign->earnings / $this->amount * 100;
    }

    /**
     * Get the campaign associated with the goal.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
