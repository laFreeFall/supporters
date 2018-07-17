<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostPrivacy extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'campaigns_posts_privacies';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */

    protected $guarded = [];

    /**
     * Get the campaign associated with the post.
     */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
}
