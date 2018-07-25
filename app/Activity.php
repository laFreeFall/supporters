<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get all of the owning Activity models.
     */
    public function subject()
    {
        return $this->morphTo();
    }

    public function getSubjectTypeAttribute($value)
    {
//        dd($value);
        if (is_null($value)) return ($value);
        return ($value . 'WithEntity');
    }
}
