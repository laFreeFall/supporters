<?php

namespace App\Http\ViewComposers;


use Illuminate\Support\Facades\Route;

class ArchivesComposer
{
    /**
     * Attaches campaign`s tags when its template is requesting
     */
    public function compose($view)
    {
        $view->with('archives', Route::current()->parameters['campaign']::archives());
    }
}