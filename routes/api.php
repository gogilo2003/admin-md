<?php

use Illuminate\Support\Facades\Route;
use Ogilo\AdminMd\Http\Controllers\Api\TagController;
use Ogilo\AdminMd\Http\Controllers\Api\LinkController;
use Ogilo\AdminMd\Http\Controllers\Api\AuthorController;

Route::middleware('api')
    ->name('api')
    ->prefix('api')
    ->namespace('Ogilo\AdminMd\Http\Controllers\Api')
    ->group(function () {
        Route::group(['as' => '-admin', 'prefix' => 'admin'], function () {
            Route::middleware(['auth:sanctum'])->group(function () {
                Route::group(['as' => '-links', 'prefix' => 'links'], function () {
                    Route::post('in_menu', [LinkController::class, 'inMenu'])->name('-in_menu');
                });

                Route::group(['as' => '-videos', 'prefix' => 'videos'], function () {
                    Route::post('', ['as' => '', 'uses' => 'VideoController@getVideos']);
                    Route::post('publish', ['as' => '-publish', 'uses' => 'VideoController@postPublish']);
                    Route::post('feature', ['as' => '-feature', 'uses' => 'VideoController@postFeature']);
                    Route::post('delete', ['as' => '-delete', 'uses' => 'VideoController@getDelete']);
                });

                Route::group(['as' => '-events', 'prefix' => 'events'], function () {
                    Route::post('', ['as' => '', 'uses' => 'EventController@getEvents']);
                    Route::post('publish', ['as' => '-publish', 'uses' => 'EventController@postPublish']);
                    Route::post('feature', ['as' => '-feature', 'uses' => 'EventController@postFeature']);
                    Route::post('delete', ['as' => '-delete', 'uses' => 'EventController@getDelete']);
                    Route::group(['as' => '-speakers', 'prefix' => 'speakers'], function () {
                        Route::post('', ['as' => '', 'uses' => 'EventSpeakerController@getEventSpeakers']);
                        Route::post('add', ['as' => '-add', 'uses' => 'EventSpeakerController@postAdd']);
                        Route::post('edit', ['as' => '-edit', 'uses' => 'EventSpeakerController@postEdit']);
                        Route::post('delete', ['as' => '-delete', 'uses' => 'EventSpeakerController@getDelete']);
                    });
                    Route::group(['as' => '-days', 'prefix' => 'days'], function () {
                        Route::post('', ['as' => '', 'uses' => 'EventDayController@getEventDays']);
                        Route::post('add', ['as' => '-add', 'uses' => 'EventDayController@postAdd']);
                        Route::post('edit', ['as' => '-edit', 'uses' => 'EventDayController@postEdit']);
                        Route::post('delete', ['as' => '-delete', 'uses' => 'EventDayController@getDelete']);
                    });
                    Route::group(['as' => '-schedules', 'prefix' => 'schedules'], function () {
                        Route::post('', ['as' => '', 'uses' => 'EventScheduleController@getEventSchedules']);
                        Route::post('add', ['as' => '-add', 'uses' => 'EventScheduleController@postAdd']);
                        Route::post('edit', ['as' => '-edit', 'uses' => 'EventScheduleController@postEdit']);
                        Route::post('delete', ['as' => '-delete', 'uses' => 'EventScheduleController@getDelete']);
                    });
                });

                Route::group(['as' => '-comments', 'prefix' => 'comments'], function () {
                    Route::post('approve', ['as' => '-approve', 'uses' => 'CommentController@approve']);
                    Route::post('reply', ['as' => '-reply', 'uses' => 'CommentController@reply']);
                    Route::post('delete', ['as' => '-delete', 'uses' => 'CommentController@delete']);
                });

                Route::group(['as' => '-setup', 'prefix' => 'setup'], function () {
                    Route::post('migrate', ['as' => '-migrate', 'uses' => 'SettingsController@postMigrate']);
                    Route::post('sitemap', ['as' => '-sitemap', 'uses' => 'SettingsController@postSitemap']);
                });

                Route::name('-tags')->prefix('tags')->group(function () {
                    Route::get('{id?}', [TagController::class, 'index']);
                    Route::post('', [TagController::class, 'store'])->name('-store');
                    Route::patch('{id}', [TagController::class, 'update'])->name('-update');
                    Route::delete('', [TagController::class, 'delete'])->name('-delete');
                    Route::post('tag', [TagController::class, 'tag'])->name('-tag');
                });

                Route::name('-authors')->prefix('authors')->group(function () {
                    Route::get('{id?}', [AuthorController::class, 'index']);
                    Route::post('', [AuthorController::class, 'store'])->name('-store');
                    Route::patch('{id}', [AuthorController::class, 'update'])->name('-update');
                    Route::delete('{id}', [AuthorController::class, 'delete'])->name('-delete');
                });
            });

            Route::middleware('guest')->group(function () {
                Route::post('login', LoginController::class)->name('-login');
            });
        });


        Route::post('/tokens/create', function (\Illuminate\Http\Request $request) {
            $token = $request->user()->createToken($request->token_name);

            return ['token' => $token->plainTextToken];
        })->middleware('auth:admin');

        Route::group(['as' => '-comments', 'prefix' => 'comments'], function () {
            Route::get('{id}/{published?}', ['as' => '', 'uses' => 'CommentController@index']);
            Route::post('reply', ['as' => '-reply', 'uses' => 'CommentController@reply']);
            Route::post('comment', ['as' => '-comment', 'uses' => 'CommentController@comment']);
        });

        // Route::group(['as'=>'-admin','prefix'=>'admin'],function(){
        // 	Route::group(['as'=>'-setup','prefix'=>'setup'],function(){
        // 		Route::post('migrate',['as'=>'-migrate','uses'=>'SettingsController@postMigrate']);
        // 		Route::post('sitemap',['as'=>'-sitemap','uses'=>'SettingsController@postSitemap']);
        // 	});
        // });


    });
