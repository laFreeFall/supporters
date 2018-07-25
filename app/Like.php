<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::deleting(function($like) {
            $like->likeable->activities->where('type', 'liked_' . strtolower(class_basename($like->likeable)))->each->delete();
        });

        static::created(function($like) {
            auth()->user()->activities()->create([
                'subject_id' => $like->likeable->id,
                'subject_type' => get_class($like->likeable),
                'type' => 'liked_' . strtolower(class_basename($like->likeable))
            ]);
        });
    }

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
    protected $with = ['likeable'];

    /**
     * Get all of the owning likeable models.
     */
    public function likeable()
    {
        return $this->morphTo();
    }
}
