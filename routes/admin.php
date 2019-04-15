<?php

/*
  |--------------------------------------------------------------------------
  | Admin Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register admin web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

//Route::get('/', 'DashboardController@getAdminLanding')->name('admin');
//prefix for admin management paths
Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    //Routes only access by admin
    Route::group(['middleware' => 'admin'], function () {
        Route::group(['namespace' => 'Admin'], function () {
            // Admin Dashboard
            Route::get('dashboard', 'DashboardController@getDashboard')->name('dashboard');
            Route::get('logout', 'DashboardController@getlogout')->name('logout');

            // Admin Program
            Route::group(['as' => 'program.', 'prefix' => 'program'], function () {
                Route::get('list', 'ProgramController@getList')->name('list');
                Route::get('create', 'ProgramController@getCreate')->name('create');
                Route::post('create', 'ProgramController@postCreate')->name('create');
                Route::get('update/{program_unique_id}', 'ProgramController@getUpdate')->name('update');
                Route::post('update/{program_unique_id}', 'ProgramController@postUpdate')->name('update');

                Route::group(['as' => 'category.', 'prefix' => 'category'], function () {
                    // Admin Program Category
                    Route::get('create', 'ProgramController@getCategoryCreate')->name('create');
                    Route::post('create', 'ProgramController@postCategoryCreate')->name('create');
                    Route::get('update', 'ProgramController@getCategoryUpdate')->name('update');
                    Route::post('update', 'ProgramController@postCategoryUpdate')->name('update');
                });

                Route::group(['as' => 'cover.', 'prefix' => 'cover'], function () {
                    // Admin Session Video
                    Route::get('update/{attachment_unique_id}', 'ProgramController@getCoverUpdate')->name('update');
                    Route::post('update/{attachment_unique_id}', 'ProgramController@postVideoUpdate')->name('update');
                });
            });

            Route::group(['as' => 'session.', 'prefix' => 'session'], function () {
                // Admin Session 
                Route::get('create', 'SessionController@getCreate')->name('create');
                Route::post('create', 'SessionController@postCreate')->name('create');
                Route::get('update/{session_unique_id}', 'SessionController@getUpdate')->name('update');
                Route::post('update/{session_unique_id}', 'SessionController@postUpdate')->name('update');
                Route::group(['as' => 'video.', 'prefix' => 'video'], function () {
                    // Admin Session Video
                    Route::get('update/{attachment_unique_id}', 'SessionController@getVideoUpdate')->name('update');
                    Route::post('update/{attachment_unique_id}', 'SessionController@postVideoUpdate')->name('update');
                });
                Route::group(['as' => 'cover.', 'prefix' => 'cover'], function () {
                    // Admin Session Video
                    Route::get('update/{attachment_unique_id}', 'SessionController@getCoverUpdate')->name('update');
                    Route::post('update/{attachment_unique_id}', 'SessionController@postVideoUpdate')->name('update');
                });
            });
            Route::group(['as' => 'resource.', 'prefix' => 'resource'], function () {
                // Admin Resource 
                Route::get('create', 'ResourceController@getCreate')->name('create');
                Route::post('create', 'ResourceController@postCreate')->name('createLocal');
                Route::post('create', 'ResourceController@postCreate')->name('createMedia');
                Route::post('create', 'ResourceController@postCreate')->name('createExternal');
                Route::get('update', 'ResourceController@getUpdate')->name('update');
                Route::post('update', 'ResourceController@postUpdate')->name('update');
            });

            // Admin Article
            Route::group(['as' => 'article.', 'prefix' => 'article'], function () {
                Route::get('list', 'ArticleController@getList')->name('list');
                Route::get('create', 'ArticleController@getCreate')->name('create');
                Route::post('create', 'ArticleController@postCreate')->name('create');
                Route::get('update/{article_unique_id}', 'ArticleController@getUpdate')->name('update');
                Route::post('update/{article_unique_id}', 'ArticleController@getUpdate')->name('update');

                Route::group(['as' => 'category.', 'prefix' => 'category'], function () {
                    // Admin Article Category
                    Route::get('create', 'ArticleController@getCategoryCreate')->name('create');
                    Route::post('create', 'ArticleController@postCategoryCreate')->name('create');
                    Route::get('update', 'ArticleController@getCategoryUpdate')->name('update');
                    Route::post('update', 'ArticleController@postCategoryUpdate')->name('update');
                });
            });
        });
    });
});
