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
                Route::group(['as' => 'create.', 'prefix' => 'create'], function () {
                    Route::get('/', 'ResourceController@getCreate')->name('option');
                    Route::get('local', 'ResourceController@getCreateLocal')->name('local');
                    Route::get('media', 'ResourceController@getCreateMedia')->name('media');
                    Route::get('external', 'ResourceController@getCreateExternal')->name('external');
                    Route::post('local', 'ResourceController@postCreateLocal')->name('local');
                    Route::post('media', 'ResourceController@postCreateMedia')->name('media');
                    Route::post('external', 'ResourceController@postCreateExternal')->name('external');
                });
                Route::group(['as' => 'update.', 'prefix' => 'update'], function () {
                    Route::get('local/{resource_unique_id}', 'ResourceController@getUpdateLocal')->name('local');
                    Route::get('media/{resource_unique_id}', 'ResourceController@getUpdateMedia')->name('media');
                    Route::get('external/{resource_unique_id}', 'ResourceController@getUpdateExternal')->name('external');
                    Route::post('local/{resource_unique_id}', 'ResourceController@postUpdateLocal')->name('local');
                    Route::post('media/{resource_unique_id}', 'ResourceController@postUpdateMedia')->name('media');
                    Route::post('external/{resource_unique_id}', 'ResourceController@postUpdateExternal')->name('external');
                });
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
