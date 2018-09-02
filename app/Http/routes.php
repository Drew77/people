<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PeopleController@index');

Route::get('/{person}', 'PeopleController@show');

Route::post('/{person}/edit', 'PeopleController@edit');

Route::post('/', 'PeopleController@create');

Route::get('/{person}/delete', 'PeopleController@delete');


