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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'FrontController@index');
Route::get('eventdetail/{id}', 'FrontController@eventdetail')->name('eventdetail');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => '/biodata', 'as' => 'biodata.'], function () {
        Route::get('/show', 'BiodataController@show')->name('show');
        Route::post('/store', 'BiodataController@store')->name('store');
        Route::post('/update', 'BiodataController@update')->name('update');
    });

    Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'middleware' => 'role:admin'], function () {
        Route::resource('/type', 'TypeController');
        Route::resource('/categories', 'CategoriesController');
        Route::resource('/units', 'UnitController');
        Route::resource('/users', 'UserController');
    });

    Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'middleware' => 'role:admin_adminevent'], function () {
        Route::resource('/events', 'EventsController');
        Route::get('participant/{id}', 'ParticipantController@index')->name('participant.index');
        Route::delete('participant/{id}', 'ParticipantController@destroy')->name('participant.destroy');
    });

    Route::group(['middleware' => 'role:peserta'], function () {
        Route::post('/regevent', 'ParticipantController@register')->name('regevent');
        Route::get('/history', 'ParticipantController@history')->name('history');
    });
});
