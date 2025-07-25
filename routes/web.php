<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'web', 'namespace' => 'Ogilo\AdminMd\Http\Controllers\Web'], function () {
    Route::get('article/{item_name}/{page?}', ['as' => 'article', 'uses' => 'PagesController@getArticle']);
    Route::get('sermon/{sermon_name}/{page_name?}', ['as' => 'sermon', 'uses' => 'PagesController@getSermon']);
    Route::get('file/{id}/{page_name?}', ['as' => 'file', 'uses' => 'PagesController@getFile']);
    Route::get('download/{id}', ['as' => 'file-download', 'uses' => 'PagesController@downlodFile']);
    Route::get('project/{id}/{page_name?}', ['as' => 'project', 'uses' => 'PagesController@getProject']);
    Route::get('profile/{id}/{page_name?}', ['as' => 'profile', 'uses' => 'PagesController@getProfile']);
    Route::get('event/{event_name}/{page_name?}', ['as' => 'event', 'uses' => 'PagesController@getEvent']);
    Route::post('event/guest/register', ['as' => 'event-guest-register', 'uses' => 'PagesController@postEventGuest']);
    Route::post('comment', ['as' => 'post-comment', 'uses' => 'PagesController@postComment']);
    Route::any('contact/post', ['as' => 'post-contact', 'uses' => 'PagesController@postContact']);
    Route::get('{page_name?}', ['as' => 'home', 'uses' => 'PagesController@getPage']);
});
