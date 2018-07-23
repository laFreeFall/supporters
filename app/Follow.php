<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follow extends Model
{
    use SoftDeletes, RecordsActivity;

    protected static function boot()
    {
        parent::boot();
        static::deleting(function($follow) {
            $follow->activities->each->delete();
        });
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'campaign_user';

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
    protected $with = ['campaign'];

    /**
     * Get the campaign associated with the follow.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get the user associated with the follow.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the activities records associated with the follow.
     */
    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
