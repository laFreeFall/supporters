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

// Campaign Posts
Route::resource('campaigns.posts', 'PostController');

// Campaign Post Comments
Route::resource('campaigns.posts.comments', 'CommentController');

// Campaign Followings
Route::post('campaigns/{campaign}/users/{user}', 'CampaignFollowController@store')->name('campaigns.follows.store');
Route::delete('campaigns/{campaign}/users/{user}', 'CampaignFollowController@destroy')->name('campaigns.follows.destroy');

// Posts Likes
Route::post('posts/{post}/like', 'PostLikeController@store')->name('posts.likes.store');
Route::delete('posts/{post}/like', 'PostLikeController@destroy')->name('posts.likes.destroy');

// Comments Likes
Route::post('comments/{comment}/like', 'CommentLikeController@store')->name('comments.likes.store');
Route::delete('comments/{comment}/like', 'CommentLikeController@destroy')->name('comments.likes.destroy');

// Campaign Tags
Route::post('campaign/{campaign}/tags', 'TagController@store')->name('campaigns.tags.store');
Route::delete('campaign/{campaign}/tags/{tag}/', 'TagController@destroy')->name('campaigns.tags.destroy');

// Campaigns Supports
Route::post('pledges/{pledge}/user/{user}', 'SupportController@store')->name('pledges.users.store');
Route::delete('pledges/{pledge}/user/{user}', 'SupportController@destroy')->name('pledges.users.destroy');
