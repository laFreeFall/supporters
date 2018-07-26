<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'campaigns';

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
//    protected $with = ['category', 'colors'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the avatar path of the campaign.
     *
     * @return string
     */
    public function getAvatarPathAttribute()
    {
        return asset($this->avatar ? "/storage/{$this->avatar}" : '/storage/images/avatars/no-avatar.png');
    }

    /**
     * Get the category of the campaign.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the user who has run the campaign.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the colors associated with the campaign.
     */
    public function colors()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    /**
     * Get the goals associated with the campaign.
     */
    public function goals()
    {
        return $this->hasMany(Goal::class)->orderBy('amount');
    }

    /**
     * Get the pledges associated with the campaign.
     */
    public function pledges()
    {
        return $this->hasMany(Pledge::class)->orderBy('amount');
    }

    /**
     * Get the posts associated with the campaign.
     */
    public function posts()
    {
        return $this->hasMany(Post::class)->withCount('comments');
    }

    /**
     * Get count of the posts associated with the campaign.
     */
    public function postsCount()
    {
        return $this->hasOne(Post::class, 'campaign_id')
            ->selectRaw('campaign_id, count(*) as count')
            ->groupBy('campaign_id');
    }

    /**
     * Get count of the posts associated with the campaign.
     *
     * @return int
     */
    public function getPostsCountAttribute()
    {
        if ( ! array_key_exists('postsCount', $this->relations))
            $this->load('postsCount');

        $related = $this->getRelation('postsCount');

        return ($related) ? (int) $related->count : 0;
    }

    /**
     * Get the users that are following the campaign.
     */
    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get count of the users following the campaign.
     */
    public function followersCount()
    {
        return $this->hasOne(Follow::class, 'campaign_id')
            ->selectRaw('campaign_id, count(*) as count')
            ->groupBy('campaign_id');
    }

    /**
     * Get count of the users following the campaign.
     *
     * @return int
     */
    public function getFollowersCountAttribute()
    {
        if ( ! array_key_exists('followersCount', $this->relations))
            $this->load('followersCount');

        $related = $this->getRelation('followersCount');

        return ($related) ? (int) $related->count : 0;
    }

    /**
     * Get the result if campaign has a follower or not.
     */
    public function hasFollower($user)
    {
        return $this->followers->contains($user);
    }

    /**
     * Get the tags registered by the campaign.
     */
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    /**
     * Get the list of the months where posts were created
     */
    public static function archives()
    {
        return Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) amount')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }

    /**
     * Filter query by applying filtering params
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    /**
     * Get the messages posted on the community tab of the campaign.
     */
    public function messages()
    {
        return $this->hasMany(Message::class)->latest();
    }

    /**
     * Get the amount of users that are supporting the campaign.
     */
    public function getSupportersCountAttribute()
    {
        return Support::whereIn('pledge_id', $this->pledges->pluck('id'))->count();
    }
}
