<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes, RecordsActivity, Likeable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'campaigns_posts_comments';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the post associated with the post.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
 * Get the author of the comment.
 */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the activities records associated with the comment.
     */
    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
