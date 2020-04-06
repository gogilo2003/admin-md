<?php

Route::group(['middleware'=>'api','as'=>'api','prefix'=>'api','namespace'=>'Ogilo\AdminMd\Http\Controllers\Api'],function(){

	Route::group(['middleware'=>'auth:api','as'=>'-admin','prefix'=>'admin'],function(){
		Route::group(['as'=>'-videos','prefix'=>'videos'],function(){
			Route::post('',['as'=>'','uses'=>'VideoController@getVideos']);
			Route::post('publish',['as'=>'-publish','uses'=>'VideoController@postPublish']);
			Route::post('feature',['as'=>'-feature','uses'=>'VideoController@postFeature']);
			Route::post('delete',['as'=>'-delete','uses'=>'VideoController@getDelete']);
		});
	});

});
