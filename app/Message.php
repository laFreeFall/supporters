<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'campaigns_messages';

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
    protected $with = [];

    /**
     * Get the author of the message.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the campaign of the message.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get all of the post's likes.
     */
    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    /**
     * Get the result is comment liked by authenticated user or not.
     */
    public function isLikedBy($id)
    {
        return !! $this->likes->where('user_id', $id)->count();
    }

    /**
     * Get the parent message of the message.
     */
    public function parent()
    {
        return $this->belongsTo(Message::class, 'repliable_id');
    }
}
