<?php

Auth::routes();

Route::get('/', 'PagesController@home')->name('home');

Route::get('profile/create', 'ProfilesController@create')->name('profile.create');
Route::post('profile/store', 'ProfilesController@store')->name('profile.store');
Route::get('profile/settings', 'ProfilesController@edit')->name('profile.edit');
Route::patch('profile/{profile}', 'ProfilesController@update')->name('profile.update');
//Route::get('profile/{user}', 'ProfilesController@index')->name('profile.index');
Route::get('@{user}', 'ProfilesController@index')->name('profile.index');
Route::get('profile', function() {
    return redirect(route('profile.index', ['user' => auth()->user()]));
});

Route::get('campaigns', 'CampaignsController@index')->name('campaign.index');
Route::get('{campaign}', 'CampaignsController@show')->name('campaign.show');
Route::get('campaigns/create', 'CampaignsController@create')->name('campaign.create');
Route::post('campaigns', 'CampaignsController@store')->name('campaign.store');
Route::get('campaign/{campaign}/edit', 'CampaignsController@edit')->name('campaign.edit');
Route::patch('campaign/{campaign}', 'CampaignsController@update')->name('campaign.update');
Route::delete('campaign/{campaign}', 'CampaignsController@delete')->name('campaign.delete');
Route::get('campaign/{campaign}/preview', 'CampaignsController@preview')->name('campaign.preview');
Route::post('campaign/{campaign}/restore', 'CampaignsController@restore')->name('campaign.restore');

// campaigns goals
Route::get('campaign/{campaign}/goals', 'CampaignsGoalsController@index')->name('campaign.goal.index');
Route::get('campaign/{campaign}/goals/create', 'CampaignsGoalsController@create')->name('campaign.goal.create');
Route::post('campaign/{campaign}/goals', 'CampaignsGoalsController@store')->name('campaign.goal.store');
Route::get('campaign/{campaign}/goal/{goal}/edit', 'CampaignsGoalsController@edit')->name('campaign.goal.edit');
Route::patch('campaign/{campaign}/goal/{goal}', 'CampaignsGoalsController@update')->name('campaign.goal.update');
Route::delete('campaign/{campaign}/goal/{goal}', 'CampaignsGoalsController@destroy')->name('campaign.goal.delete');
