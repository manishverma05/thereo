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


Route::get('/', 'HomeController@landing')->name('landing');
Route::get('/unauthorize', 'HomeController@unauthorize')->name('unauthorize');
Auth::routes();
Route::group(['as' => 'user.'], function () {
    Route::get('about', 'HomeController@about')->name('about');
    Route::get('programs', 'ProgramController@index')->name('programs');
    Route::group(['as' => 'program.', 'prefix' => 'program'], function () {
        Route::get('/{program_slug}', 'ProgramController@detail')->name('detail');
        Route::group(['as' => 'category.', 'prefix' => 'category'], function () {
            Route::get('/{category_slug}', 'ProgramCategoryController@detail')->name('detail');
        });
        Route::group(['as' => 'resource.', 'prefix' => 'resource'], function () {
            Route::get('/{program_slug}/{type?}', 'ProgramResourceController@index')->name('list');
        });
        Route::group(['as' => 'update.', 'prefix' => 'update'], function () {
            Route::get('/{program_slug}', 'ProgramUpdateController@index')->name('list');
        });

        Route::group(['as' => 'session.', 'prefix' => 'session'], function () {
            Route::get('/{program_slug}', 'SessionController@index')->name('list');
//                Route::group(['as' => 'category.', 'prefix' => 'category'], function () {
//                    Route::get('/{category_slug}', 'SessionCategoryController@detail')->name('detail');
//                });
//                Route::group(['as' => 'update.', 'prefix' => 'update'], function () {
//                    Route::get('/{session_slug}', 'SessionUpdateController@index')->name('list');
//                });
        });
    });
    Route::group(['as' => 'session.', 'prefix' => 'session'], function () {
        Route::group(['as' => 'resource.', 'prefix' => 'resource'], function () {
            Route::get('/{session_slug}/{type?}', 'SessionResourceController@index')->name('list');
        });
        Route::group(['as' => 'material.', 'prefix' => 'material'], function () {
            Route::get('/{session_slug}/{type?}', 'SessionMaterialController@index')->name('list');
        });
    });
    Route::group(['as' => 'session.', 'prefix' => 'session'], function () {
        Route::get('/{session_slug}', 'SessionController@detail')->name('detail');
        Route::group(['as' => 'category.', 'prefix' => 'category'], function () {
            Route::get('/{category_slug}', 'SessionCategoryController@detail')->name('detail');
        });
        Route::group(['as' => 'resource.', 'prefix' => 'resource'], function () {
            Route::get('/{session_slug}/{type?}', 'SessionResourceController@index')->name('list');
        });
        Route::group(['as' => 'update.', 'prefix' => 'update'], function () {
            Route::get('/{session_slug}', 'SessionUpdateController@index')->name('list');
        });
    });
    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', 'HomeController@getlogout')->name('logout');
        Route::get('home', 'HomeController@index')->name('home');
        Route::get('dashboard', 'DashboardController@getDashboard')->name('dashboard');
    });
});
