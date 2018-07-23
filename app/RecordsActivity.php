<?php

namespace App;

trait RecordsActivity
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    static protected $activitiesToRecord = ['created'];

    protected static function bootRecordsActivity ()
    {
        foreach(self::$activitiesToRecord as $event) {
            static::$event(function($model) use($event) {
                $model->recordActivity($event);
            });
        }
    }

    protected function recordActivity($event)
    {
        auth()->user()->activities()->create([
            'subject_id' => $this->id,
            'subject_type' => get_class($this),
            'type' => $event . '_' . strtolower(class_basename($this))
        ]);
    }
}