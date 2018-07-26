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
        static::created(function($support) {
            auth()->user()->activities()->create([
                'subject_id' => $support->pledge->id,
                'subject_type' => get_class($support->pledge),
                'type' => 'supported_' . strtolower(class_basename($support->pledge))
            ]);
        });
        static::updated(function($support) {
//            $follow->activities->each->delete();
            auth()->user()->activities()->create([
                'subject_id' => $support->pledge->id,
                'subject_type' => get_class($support->pledge),
                'type' => 'supported' . strtolower(class_basename($support->pledge))
            ]);
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
