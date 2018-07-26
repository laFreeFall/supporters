<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageWithEntity extends Message
{
    /**
     * The relations that loads by default with the instance.
     *
     * @var array
     */
    protected $with = ['campaign', 'parent'];
}
