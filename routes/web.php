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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function()
{
	Route::put('/jobs/approve/{jobs}', 'JobController@approve');
	Route::put('/jobs/decline/{jobs}', 'JobController@decline');
	Route::put('/jobs/done/{jobs}', 'JobController@done');
	Route::resource('/jobs', 'JobController');
	Route::resource('/machines', 'MachineController');
});