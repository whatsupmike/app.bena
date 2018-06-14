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
    return redirect()->route('trip.create');
});

Auth::routes();
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::resource('car', 'CarController');
        Route::resource('trip', 'TripController');
        Route::resource('fuel', 'FuelController');
        Route::get('/analysis', 'AnalysisController@index')->name('analysis');
        Route::get('/analysis/settlement', 'AnalysisController@settle')->name('analysis.settlement');
        Route::post('/analysis/paid', 'AnalysisController@paid');
    });

