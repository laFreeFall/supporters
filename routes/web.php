<?php

Auth::routes();

Route::get('/', 'PageController@home')->name('home');
Route::get('/test', 'PageController@test')->name('text');

// Users Profiles
Route::get('@{profile}', 'ProfileController@show')->name('profiles.show');
Route::get('profile', function() {
    return redirect(route('profiles.show', ['profile' => auth()->user()->profile]));
});
Route::resource('profiles', 'ProfileController')->except(['show']);

// Campaigns
Route::get('campaigns/{campaign}/preview', 'CampaignController@preview')->name('campaigns.preview');
Route::post('campaigns/{campaign}/restore', 'CampaignController@restore')->name('campaigns.restore');
Route::resource('campaigns', 'CampaignController');

// Campaign Goals
Route::resource('campaigns.goals', 'GoalController');

// Campaign Pledges
Route::resource('campaigns.pledges', 'PledgeController');
