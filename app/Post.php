<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'campaigns_posts';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */

    protected $guarded = [];

    /**
     * Get the campaign associated with the post.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get the campaign associated with the post.
     */
    public function privacy()
    {
        return $this->belongsTo(PostPrivacy::class, 'privacy_id');
    }
}
