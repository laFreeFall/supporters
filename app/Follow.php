<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::created(function($follow) {
            auth()->user()->activities()->create([
                'subject_id' => $follow->campaign->id,
                'subject_type' => get_class($follow->campaign),
                'type' => 'followed_' . strtolower(class_basename($follow->campaign))
            ]);
        });
        static::deleting(function($follow) {
//            $follow->activities->each->delete();
            auth()->user()->activities()->create([
                'subject_id' => $follow->campaign->id,
                'subject_type' => get_class($follow->campaign),
                'type' => 'unfollowed_' . strtolower(class_basename($follow->campaign))
            ]);
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
