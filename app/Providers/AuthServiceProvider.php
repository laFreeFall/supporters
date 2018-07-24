<?php

namespace App\Providers;

use App\Campaign;
use App\Policies\CampaignPolicy;
use App\Profile;
use App\Policies\ProfilePolicy;
use App\Post;
use App\Policies\PostPolicy;
use App\Comment;
use App\Policies\CommentPolicy;
use App\Message;
use App\Policies\MessagePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Campaign::class => CampaignPolicy::class,
        Profile::class => ProfilePolicy::class,
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
        Message::class => MessagePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
