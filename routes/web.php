<?php

use Illuminate\Support\Facades\Route;


Route::get('/','MoviesController@index')->name('movies.index');

Route::get('movies/{id}', 'MoviesController@show')->name('movies.show');

Route::get('/actors', 'ActorController@index')->name('actors.index');
Route::get('/actors/page/{page?}', 'ActorController@index');

Route::get('/actors_show/{id}', 'ActorController@show')->name('actors.show');

Route::get('/tv', 'TvController@index')->name('tv.index');
Route::get('/tv/{id}', 'TvController@show')->name('tv.show');


