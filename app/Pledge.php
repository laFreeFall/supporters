<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pledge extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'campaigns_pledges';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the campaign associated with the pledge.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get the supports records associated with the pledge.
     */
    public function supports()
    {
        return $this->hasMany(Support::class);
    }
}
