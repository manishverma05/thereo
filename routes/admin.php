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

                // Admin Program Category
                Route::group(['as' => 'category.', 'prefix' => 'category'], function () {
                    Route::get('create', 'ProgramController@getCategoryCreate')->name('create');
                    Route::post('create', 'ProgramController@postCategoryCreate')->name('create');
                    Route::get('update/{program_category_unique_id}', 'ProgramController@getCategoryUpdate')->name('update');
                    Route::post('update/{program_category_unique_id}', 'ProgramController@postCategoryUpdate')->name('update');
                });

                // Admin Program Update
                Route::group(['as' => 'update.', 'prefix' => 'update'], function () {
                    Route::get('create/{program_unique_id}', 'ProgramController@getUpdateCreate')->name('create');
                    Route::post('create/{program_unique_id}', 'ProgramController@postUpdateCreate')->name('create');
                    Route::get('update/{program_unique_id}/{program_update_unique_id}', 'ProgramController@getUpdateUpdate')->name('update');
                    Route::post('update/{program_unique_id}/{program_update_unique_id}', 'ProgramController@postUpdateUpdate')->name('update');
                });

                Route::group(['as' => 'resource.', 'prefix' => 'resource'], function () {
                    // Admin Resource 
                    Route::group(['as' => 'create.', 'prefix' => 'create'], function () {
                        Route::get('/{program_unique_id}', 'ResourceController@getProgramCreate')->name('option');
                        Route::get('local/{program_unique_id}', 'ResourceController@getCreateProgramLocal')->name('local');
                        Route::get('media/{program_unique_id}', 'ResourceController@getCreateProgramMedia')->name('media');
                        Route::get('external/{program_unique_id}', 'ResourceController@getCreateProgramExternal')->name('external');
                        Route::post('local/{program_unique_id}', 'ResourceController@postCreateProgramLocal')->name('local');
                        Route::post('media/{program_unique_id}', 'ResourceController@postCreateProgramMedia')->name('media');
                        Route::post('external/{program_unique_id}', 'ResourceController@postCreateProgramExternal')->name('external');
                    });
                    Route::group(['as' => 'update.', 'prefix' => 'update'], function () {
                        Route::get('local/{program_unique_id}/{resource_unique_id}', 'ResourceController@getUpdateProgramLocal')->name('local');
                        Route::get('media/{program_unique_id}/{resource_unique_id}', 'ResourceController@getUpdateProgramMedia')->name('media');
                        Route::get('external/{program_unique_id}/{resource_unique_id}', 'ResourceController@getUpdateProgramExternal')->name('external');
                        Route::post('local/{program_unique_id}/{resource_unique_id}', 'ResourceController@postUpdateProgramLocal')->name('local');
                        Route::post('media/{program_unique_id}/{resource_unique_id}', 'ResourceController@postUpdateProgramMedia')->name('media');
                        Route::post('external/{program_unique_id}/{resource_unique_id}', 'ResourceController@postUpdateProgramExternal')->name('external');
                    });
                });







                Route::group(['as' => 'session.', 'prefix' => 'session'], function () {

                    // Admin Program Session 
                    Route::get('create/{program_unique_id}', 'SessionController@getCreate')->name('create');
                    Route::post('create/{program_unique_id}', 'SessionController@postCreate')->name('create');
                    Route::get('update/{program_unique_id}/{session_unique_id}', 'SessionController@getUpdate')->name('update');
                    Route::post('update/{program_unique_id}/{session_unique_id}', 'SessionController@postUpdate')->name('update');
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









                Route::group(['as' => 'cover.', 'prefix' => 'cover'], function () {
                    // Admin Session Video
                    Route::get('update/{attachment_unique_id}', 'ProgramController@getCoverUpdate')->name('update');
                    Route::post('update/{attachment_unique_id}', 'ProgramController@postVideoUpdate')->name('update');
                });
                Route::group(['as' => 'session.', 'prefix' => 'session'], function () {
                    // Admin Session 
                    Route::get('create/{program_unique_id}', 'SessionController@getCreate')->name('create');
                    Route::post('create/{program_unique_id}', 'SessionController@postCreate')->name('create');
                    Route::get('update/{program_unique_id}/{session_unique_id}', 'SessionController@getUpdate')->name('update');
                    Route::post('update/{program_unique_id}/{session_unique_id}', 'SessionController@postUpdate')->name('update');
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
