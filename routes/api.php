<?php

Route::group(['middleware'=>'api','as'=>'api','prefix'=>'api','namespace'=>'Ogilo\AdminMd\Http\Controllers\Api'],function(){

	Route::group(['middleware'=>'auth:api','as'=>'-admin','prefix'=>'admin'],function(){
		Route::group(['as'=>'-videos','prefix'=>'videos'],function(){
			Route::post('',['as'=>'','uses'=>'VideoController@getVideos']);
			Route::post('publish',['as'=>'-publish','uses'=>'VideoController@postPublish']);
			Route::post('feature',['as'=>'-feature','uses'=>'VideoController@postFeature']);
			Route::post('delete',['as'=>'-delete','uses'=>'VideoController@getDelete']);
		});

		Route::group(['as'=>'-events','prefix'=>'events'],function(){
			Route::post('',['as'=>'','uses'=>'EventController@getEvents']);
			Route::post('publish',['as'=>'-publish','uses'=>'EventController@postPublish']);
			Route::post('feature',['as'=>'-feature','uses'=>'EventController@postFeature']);
            Route::post('delete',['as'=>'-delete','uses'=>'EventController@getDelete']);
            Route::group(['as'=>'-speakers','prefix'=>'speakers'],function(){
                Route::post('',['as'=>'','uses'=>'EventSpeakerController@getEventSpeakers']);
                Route::post('add',['as'=>'-add','uses'=>'EventSpeakerController@postAdd']);
                Route::post('edit',['as'=>'-edit','uses'=>'EventSpeakerController@postEdit']);
                Route::post('delete',['as'=>'-delete','uses'=>'EventSpeakerController@getDelete']);
            });
            Route::group(['as'=>'-days','prefix'=>'days'],function(){
                Route::post('',['as'=>'','uses'=>'EventDayController@getEventDays']);
                Route::post('add',['as'=>'-add','uses'=>'EventDayController@postAdd']);
                Route::post('edit',['as'=>'-edit','uses'=>'EventDayController@postEdit']);
                Route::post('delete',['as'=>'-delete','uses'=>'EventDayController@getDelete']);
            });
            Route::group(['as'=>'-schedules','prefix'=>'schedules'],function(){
                Route::post('',['as'=>'','uses'=>'EventScheduleController@getEventSchedules']);
                Route::post('add',['as'=>'-add','uses'=>'EventScheduleController@postAdd']);
                Route::post('edit',['as'=>'-edit','uses'=>'EventScheduleController@postEdit']);
                Route::post('delete',['as'=>'-delete','uses'=>'EventScheduleController@getDelete']);
            });
		});

		Route::group(['as'=>'-comments','prefix'=>'comments'],function(){
			Route::post('approve',['as'=>'-approve','uses'=>'CommentController@approve']);
			Route::post('reply',['as'=>'-reply','uses'=>'CommentController@reply']);
			Route::post('delete',['as'=>'-delete','uses'=>'CommentController@delete']);
		});

		Route::group(['as'=>'-setup','prefix'=>'setup'],function(){
			Route::post('migrate',['as'=>'-migrate','uses'=>'SettingsController@postMigrate']);
			Route::post('sitemap',['as'=>'-sitemap','uses'=>'SettingsController@postSitemap']);
		});
	});

	Route::group(['as'=>'-comments','prefix'=>'comments'],function(){
		Route::get('{id}/{published?}',['as'=>'-reply','uses'=>'CommentController@index']);
		Route::post('reply',['as'=>'-reply','uses'=>'CommentController@reply']);
		Route::post('comment',['as'=>'-comment','uses'=>'CommentController@comment']);
	});

	// Route::group(['as'=>'-admin','prefix'=>'admin'],function(){
	// 	Route::group(['as'=>'-setup','prefix'=>'setup'],function(){
	// 		Route::post('migrate',['as'=>'-migrate','uses'=>'SettingsController@postMigrate']);
	// 		Route::post('sitemap',['as'=>'-sitemap','uses'=>'SettingsController@postSitemap']);
	// 	});
	// });


});
