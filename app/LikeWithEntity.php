<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LikeWithEntity extends Like
{
    /**
     * The relations that loads by default with the instance.
     *
     * @var array
     */
    protected $with = ['likeable'];
}
