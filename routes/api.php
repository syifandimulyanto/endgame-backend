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

Route::namespace('API')->group(function () {

    // Authentication Routes...
    Route::post('login', 'APIAuthController@login');

    // Schedule Attend
    Route::post('attend', 'APIScheduleAttendController@store');

    Route::middleware('auth.api')->group(function (){
        // user data ..
        Route::post('profile/password', 'APIProfileController@changePassword');
        Route::resource('profile', 'APIProfileController');

        // schedule
        Route::resource('schedule', 'APIScheduleController');

        // Schedule Attend
        Route::get('attend', 'APIScheduleAttendController@index');

        // Schedule Change
        Route::get('scheduleChange', 'APIScheduleChangeController@index');

        // notification
        Route::resource('notification', 'APINotificationController')->only(['index']);

        // slider
        Route::resource('slider', 'APISliderController')->only(['index']);
    });

    // Schedule Attend
    Route::get('attend-with-nrp', 'APIScheduleAttendController@attend');

    Route::post('attend-upload', 'APIScheduleAttendController@attendUpload');
});
