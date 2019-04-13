<?php
Route::group(['as'=>'admin-hits','prefix'=>'admin/hits','namespace'=>'Ogilo\Admin\Http\Controllers'],function(){
	Route::post('',['as'=>'', 'uses'=>'HitsController@index']);
	Route::post('browsers',['as'=>'-browsers', 'uses'=>'HitsController@browsers']);
	Route::post('platforms',['as'=>'-platforms', 'uses'=>'HitsController@platforms']);
	Route::post('weekly/platforms',['as'=>'-weekly-platforms', 'uses'=>'HitsController@weeklyPlatforms']);
	Route::post('weekly/browsers',['as'=>'-weekly-browsers', 'uses'=>'HitsController@weeklyBrowsers']);
	Route::post('monthly/platforms',['as'=>'-monthly-platforms', 'uses'=>'HitsController@monthlyPlatforms']);
	Route::post('monthly/browsers',['as'=>'-monthly-browsers', 'uses'=>'HitsController@monthlyBrowsers']);
});