<?php

Auth::routes();

Route::get('/', 'PagesController@home')->name('home');
