<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', 'PictureController@index')->name('index');

Route::get('/', 'PictureController@index')->name('index');
Route::get('/pictures/{id}', 'PictureController@show')->name('show');
Route::get('/delete/{id}', 'PictureController@destroy')->name('destroy');
Route::get('/create', 'PictureController@create')->name('create');
Route::post('/store', 'PictureController@store')->name('store');
Route::get('/edit/{id}', 'PictureController@edit')->name('edit');
Route::post('/update/{id}','PictureController@update')->name('update');
Route::get('/tag/{id}', 'PictureController@showtag')->name('showtag');
Route::post('/searchtag','TagController@searchTags')->name('searchtag');

Auth::routes();
