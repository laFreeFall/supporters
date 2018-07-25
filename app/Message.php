<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use Likeable;

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
     * Get the parent message of the message.
     */
    public function parent()
    {
        return $this->belongsTo(Message::class, 'repliable_id');
    }
}
