<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Support extends Model
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
    protected $table = 'pledge_user';

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
    protected $with = ['pledge.campaign'];

    /**
     * Get the pledge associated with the support.
     */
    public function pledge()
    {
        return $this->belongsTo(Pledge::class);
    }

    /**
     * Get the user associated with the support.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the activities records associated with the campaign.
     */
    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
