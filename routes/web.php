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


Route::get('/', 'HomeController@landingLogin')->name('landing');
Route::get('/unauthorize', 'HomeController@unauthorize')->name('unauthorize');
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@landing')->name('landing');
    Route::group(['as' => 'user.'], function () {
        Route::get('logout', 'HomeController@getlogout')->name('logout');
        Route::get('home', 'HomeController@index')->name('home');
        Route::get('about', 'HomeController@about')->name('about');
        Route::get('programs', 'ProgramController@index')->name('programs');
        Route::group(['as' => 'program.', 'prefix' => 'program'], function () {
            Route::get('/{program_slug}', 'ProgramController@detail')->name('detail');
            Route::group(['as' => 'category.', 'prefix' => 'category'], function () {
                Route::get('/{category_slug}', 'ProgramCategoryController@detail')->name('detail');
            });
        });
    });
});
