<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use SoftDeletes, RecordsActivity;

    protected static function boot()
    {
        parent::boot();
        static::deleting(function($like) {
            $like->activities->each->delete();
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

    /**
     * Get the activities records associated with the like.
     */
    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
