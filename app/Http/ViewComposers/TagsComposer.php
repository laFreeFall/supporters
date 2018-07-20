<?php

namespace App\Http\ViewComposers;


use Illuminate\Support\Facades\Route;

class TagsComposer
{
    /**
     * Attaches campaign`s tags when its template is requesting
     */
    public function compose($view)
    {
        $view->with('tags', Route::current()->parameters['campaign']->tags()
            ->withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->get()
        );
    }
}