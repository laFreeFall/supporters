<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes, RecordsActivity;

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
     * The relations that loads by default with the instance.
     *
     * @var array
     */
    protected $with = ['post'];

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
     * Get all of the post's likes.
     */
    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    /**
     * Get the result is comment liked by authenticated user or not.
     */
    public function isLiked()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }
}
