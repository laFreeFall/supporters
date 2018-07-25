<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes, RecordsActivity, Likeable;

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
     * The relations that loads by default with the instance.
     *
     * @var array
     */
    protected $with = ['privacy', 'tags'];

    /**
     * Get the campaign associated with the post.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get the privacy level of the post.
     */
    public function privacy()
    {
        return $this->belongsTo(PostPrivacy::class, 'privacy_id');
    }

    /**
     * Get the comments written to the post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    /**
     * Get the tags attached to the post.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    /**
     * Filter query by applying filtering params
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    /**
     * Get the activities records associated with the post.
     */
    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
