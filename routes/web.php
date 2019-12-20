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
Route::get('/about', function(){
    return view('about');
});
Route::get('eventdetail/{id}', 'FrontController@eventdetail')->name('eventdetail');

// Auth::routes();
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['namespace' => 'Authentication'], function () {
    Route::get('login', 'LoginController@index')->name('login');
    Route::get('sso/{email}/{sessionid}', 'LoginController@sso');

    // Route::get('register', 'RegisterController@index')->name('register.index');
    // Route::post('register', 'RegisterController@create')->name('register');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/regevent', 'ParticipantController@register')->name('regevent');
    Route::get('/history', 'ParticipantController@history')->name('history');
    Route::get('print/{id}', 'CardController@print')->name('card.print');

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

    Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'middleware' => 'role:admin_dosen_tendik_mahasiswa'], function () {
        Route::resource('/events', 'EventsController');
        Route::get('participant/{id}', 'ParticipantController@index')->name('participant.index');
        Route::delete('participant/{id}', 'ParticipantController@destroy')->name('participant.destroy');

        Route::post('selecttype', 'SelectTypeController@store')->name('selectype.store');
        Route::post('selecttypeDel', 'SelectTypeController@destroy')->name('selectype.delete');
    });
});
