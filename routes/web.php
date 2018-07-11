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
