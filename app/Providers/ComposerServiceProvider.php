<?php

namespace App\Providers;

use App\Http\ViewComposers\ArchivesComposer;
use App\Http\ViewComposers\TagsComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('campaigns.tags._index', TagsComposer::class);
        view()->composer('campaigns.archives._index', ArchivesComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
