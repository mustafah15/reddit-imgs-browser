<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/','HomePageController@getIndex')->name('homepage');

Route::get('next/{url}/{count}','HomePageController@getPaginateNext')->name('next-pagination');
Route::get('prev/{url}/{count}','HomePageController@getPaginatePrev')->name('prev-pagination');