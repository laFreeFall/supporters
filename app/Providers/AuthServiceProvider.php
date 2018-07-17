<?php

namespace App\Providers;

use App\Campaign;
use App\Policies\CampaignPolicy;
use App\Goal;
use App\Policies\GoalPolicy;
use App\Pledge;
use App\Policies\PledgePolicy;
use App\Profile;
use App\Policies\ProfilePolicy;
use Illuminate\Support\Facades\Gate;
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
        Pledge::class => PledgePolicy::class,
        Goal::class => GoalPolicy::class,
        Profile::class => ProfilePolicy::class
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
