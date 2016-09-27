<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['namespace' => 'Api'], function()
{
	Route::get('/tips', 'JobController@index');
	Route::put('/jobs/done-washer/{jobs}','JobController@queueDryer');
	Route::put('/jobs/done-dryer/{jobs}', 'JobController@done');

	Route::post('/jobs/pay/{jobs}', 'JobController@pay');
	Route::post('/users', 'UserController@store');
	Route::put('/jobs/cancel/{jobs}', 'JobController@cancel');
	Route::post('/jobs', 'JobController@store');
	Route::post('/jobs/walk-in', 'JobController@storeWalkin');
	Route::get('/jobs/{jobs}', 'JobController@show');
	Route::get('/machines', 'MachineController@all');

	Route::group(['namespace' => 'User', 'prefix' => '/me', 'middleware' => 'auth:api'], function()
	{
		Route::get('/', 'ProfileController@user');
		Route::get('/jobs', 'JobController@index');
		Route::post('/jobs/walk-in', 'JobController@storeWalkin');
		Route::get('/jobs/{jobs}', 'JobController@show');
		Route::post('/jobs', 'JobController@store');
	});
});