<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');

    // get the pub-sub manager
    $pubsub = app('pubsub');

    // note: function calls on the manager are proxied through to the default connection
    // eg: you can do this on the manager OR a connection
    $pubsub->publish('sync-training', 'Hallo Fandi');

});


Route::resource('courses', 'CoursesController');

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function (){

    Route::group(['middleware' => ['no-auth']], function(){
        Route::get('login', 'Auth\LoginController@form')->name('login.form');
        Route::post('login', 'Auth\LoginController@login')->name('login');
    });

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    // Route Core
    Route::namespace('Core')->prefix('core')->name('core.')->group(function (){
        Route::resource('menu', 'MenuController');

    });

    // Route Master
    Route::namespace('Master')->name('master.')->group(function (){
        // DataTable
        Route::get('room/datatable', 'RoomController@datatable')->name('room.datatable');
        Route::get('class/datatable', 'ClassController@datatable')->name('class.datatable');
        Route::get('program-study/datatable', 'ProgramStudyController@datatable')->name('program-study.datatable');
        Route::get('course/datatable', 'CourseController@datatable')->name('course.datatable');

        // Master
        Route::resource('room', 'RoomController');
        Route::resource('class', 'ClassController');
        Route::resource('program-study', 'ProgramStudyController');
        Route::resource('course', 'CourseController');

    });

    // Route User
    Route::namespace('User')->name('user.')->group(function (){
        // DataTable
        Route::get('account/datatable', 'UserAccountController@datatable')->name('account.datatable');
        Route::get('lecture/datatable', 'LectureController@datatable')->name('lecture.datatable');
        Route::get('student/datatable', 'StudentController@datatable')->name('student.datatable');

        // User
        Route::resource('account', 'UserAccountController');
        Route::resource('lecture', 'LectureController');
        Route::resource('student', 'StudentController');
    });
});
