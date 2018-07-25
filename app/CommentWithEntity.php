<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentWithEntity extends Comment
{
    /**
     * The relations that loads by default with the instance.
     *
     * @var array
     */
    protected $with = ['author.profile', 'post.campaign', 'likes'];
}
