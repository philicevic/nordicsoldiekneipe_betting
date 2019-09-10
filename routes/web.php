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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function() {
    Route::prefix('betting')->group(function() {
        Route::get('/', 'BettingController@list')->name('betting');

        Route::middleware('admin')->group(function() {
            Route::get('create', 'BettingController@createGame')->name('betting.createGame');
            Route::put('create', 'BettingController@storeGame')->name('betting.storeGame');

            Route::prefix('{game}/admin')->group(function() {
                Route::get('/', 'BettingController@gameAdmin')->name('betting.gameAdmin');

                Route::get('create/team', 'BettingController@createTeam')->name('betting.createTeam');
                Route::put('create/team', 'BettingController@storeTeam')->name('betting.storeTeam');
                Route::get('create/match', 'BettingController@createMatch')->name('betting.createMatch');
                Route::put('create/match', 'BettingController@storeMatch')->name('betting.storeMatch');
                Route::get('create/stage', 'StageController@create')->name('betting.createStage');
                Route::put('create/stage', 'StageController@store')->name('betting.storeStage');
            });
        });

        Route::get('{game}', 'BettingController@show')->name('betting.show');
        Route::get('{game}/{match}', 'BettingController@showMatch')->name('betting.match');
        Route::post('{game}/{match}', 'BettingController@saveBet')->name('betting.match.saveBet');
    });
});

