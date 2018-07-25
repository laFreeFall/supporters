<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostWithEntity extends Post
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'campaigns_posts';

    /**
     * The relations that loads by default with the instance.
     *
     * @var array
     */
    protected $with = ['campaign', 'likes', 'privacy', 'tags'];

}
