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
	Route::get('/jobs/queue', 'JobController@getQueue');
	Route::get('/jobs/reservations/create', 'JobController@reservation');
	Route::get('/jobs/walk-ins/create', 'JobController@walkin');
	Route::get('/jobs/reservations', 'JobController@getReservations');
	Route::get('/jobs/walk-ins', 'JobController@getWalkins');

	Route::post('/jobs/reservation', 'JobController@storeReservation');
	Route::post('/jobs/walk-in', 'JobController@storeWalkin');
	
	Route::put('/jobs/approve/{jobs}', 'JobController@approve');
	Route::put('/jobs/decline/{jobs}', 'JobController@decline');
	Route::put('/jobs/done/{jobs}', 'JobController@done');
	Route::put('/jobs/queue-washer/{jobs}', 'JobController@queueWasher');
	Route::put('/jobs/queue-dryer/{jobs}','JobController@queueDryer');
	Route::put('/jobs/cancel/{jobs}', 'JobController@cancel');
	Route::put('/jobs/paid/{jobs}', 'JobController@paid');
	Route::resource('/jobs', 'JobController');
	Route::resource('/machines', 'MachineController');
	Route::resource('/tips', 'TipController');

	Route::get('/reports', 'ReportController@home');
});