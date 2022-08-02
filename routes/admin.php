<?php

use Illuminate\Support\Facades\Route;
use Ogilo\AdminMd\Http\Controllers\TagController;
use Ogilo\AdminMd\Http\Controllers\BlogController;
use Ogilo\AdminMd\Http\Controllers\ProfileController;

Route::group(['middleware' => 'web', 'as' => 'admin', 'prefix' => 'admin', 'namespace' => 'Ogilo\AdminMd\Http\Controllers'], function () {

    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', ['as' => '-login', 'uses' => 'AuthController@getLogin']);
        Route::post('login', ['as' => '-login', 'uses' => 'AuthController@postLogin']);
    });

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('', ['as' => '-dashboard', 'uses' => 'HomeController@getDashboard']);
        Route::get('logout', ['as' => '-logout', 'uses' => 'AuthController@getLogout']);
        Route::post('images_upload_url', ['as' => '-images_upload_url', 'uses' => 'HomeController@postImageUpload']);

        Route::group(['as' => '-profile', 'prefix' => 'profile'], function () {
            Route::get('', ['uses' => 'AuthController@getProfile']);
            Route::post('', ['uses' => 'AuthController@postProfile'])->name('-post');
        });

        Route::group(['as' => '-password', 'prefix' => 'password'], function () {
            Route::get('', ['uses' => 'AuthController@getPassword']);
            Route::post('', ['uses' => 'AuthController@postPassword'])->name('-post');
        });

        Route::group(['as' => '-options', 'prefix' => 'options'], function () {
            Route::get('', ['uses' => 'OptionsController@getOptions']);
            Route::get('add', ['uses' => 'OptionsController@getAdd'])->name('-add');
            Route::post('add', ['uses' => 'OptionsController@postAdd'])->name('-add-post');
            Route::get('edit', ['uses' => 'OptionsController@getEdit'])->name('-edit');
            Route::post('edit', ['uses' => 'OptionsController@postEdit'])->name('-edit-post');
            Route::post('delete', ['uses' => 'OptionsController@postDelete'])->name('-delete');
        });

        Route::group(['as' => '-roles', 'prefix' => 'roles'], function () {
            Route::get('', ['uses' => 'RoleController@getRoles']);
            Route::get('add', ['as' => '-add', 'uses' => 'RoleController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'RoleController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'RoleController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'RoleController@postEdit']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'RoleController@postDelete']);
        });

        Route::group(['as' => '-users', 'prefix' => 'users'], function () {
            Route::get('', ['uses' => 'UserController@getUsers']);
            Route::get('add', ['as' => '-add', 'uses' => 'UserController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'UserController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'UserController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'UserController@postEdit']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'UserController@postDelete']);
            Route::post('activate', ['as' => '-activate', 'uses' => 'UserController@postActivate']);
            Route::post('password', ['as' => '-password', 'uses' => 'UserController@postPassword']);
        });

        Route::group(['as' => '-menus', 'prefix' => 'menus'], function () {
            Route::get('', ['uses' => 'MenuController@getMenus']);
            Route::get('add', ['as' => '-add', 'uses' => 'MenuController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'MenuController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'MenuController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'MenuController@postEdit']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'MenuController@postDelete']);
        });

        Route::group(['as' => '-links', 'prefix' => 'links'], function () {
            Route::get('', ['uses' => 'LinkController@getLinks']);
            Route::get('add', ['as' => '-add', 'uses' => 'LinkController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'LinkController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'LinkController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'LinkController@postEdit']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'LinkController@postDelete']);
            Route::post('order', ['as' => '-order', 'uses' => 'LinkController@postOrder']);
        });

        Route::group(['as' => '-pages', 'prefix' => 'pages'], function () {
            Route::get('', ['uses' => 'PageController@getPages']);
            Route::get('add', ['as' => '-add', 'uses' => 'PageController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'PageController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'PageController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'PageController@postEdit']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'PageController@postDelete']);
        });

        Route::group(['as' => '-article_categories', 'prefix' => 'article_categories'], function () {
            Route::get('', ['uses' => 'ArticleCategoryController@getArticleCategories']);
            Route::get('add', ['as' => '-add', 'uses' => 'ArticleCategoryController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'ArticleCategoryController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'ArticleCategoryController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'ArticleCategoryController@postEdit']);
            Route::post('pages', ['as' => '-pages', 'uses' => 'ArticleCategoryController@postPages']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'ArticleCategoryController@postDelete']);
        });

        Route::group(['as' => '-articles', 'prefix' => 'articles'], function () {
            Route::get('', ['uses' => 'ArticleController@getArticles']);
            Route::get('add', ['as' => '-add', 'uses' => 'ArticleController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'ArticleController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'ArticleController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'ArticleController@postEdit']);
            Route::post('publish', ['as' => '-publish', 'uses' => 'ArticleController@postPublish']);
            Route::post('feature', ['as' => '-feature', 'uses' => 'ArticleController@postFeature']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'ArticleController@postDelete']);
        });

        Route::group(['as' => '-blogs', 'prefix' => 'blogs'], function () {
            Route::get('', [BlogController::class, 'getBlogs']);
            Route::get('add', [BlogController::class, 'getAdd'])->name('-add');
            Route::post('add', [BlogController::class, 'postAdd'])->name('-add-post');
            Route::get('edit/{id?}', [BlogController::class, 'getEdit'])->name('-edit');
            Route::get('view/{id?}', [BlogController::class, 'getView'])->name('-view');
            Route::post('edit', [BlogController::class, 'postEdit'])->name('-edit-post');
            Route::post('publish', [BlogController::class, 'postPublish'])->name('-publish');
            Route::post('feature', [BlogController::class, 'postFeature'])->name('-feature');
            Route::post('delete', [BlogController::class, 'postDelete'])->name('-delete');
        });

        Route::group(['as' => '-picture_categories', 'prefix' => 'picture_categories'], function () {
            Route::get('', ['uses' => 'PictureCategoryController@getPictureCategories']);
            Route::get('add', ['as' => '-add', 'uses' => 'PictureCategoryController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'PictureCategoryController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'PictureCategoryController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'PictureCategoryController@postEdit']);
            Route::post('pages', ['as' => '-pages', 'uses' => 'PictureCategoryController@postPages']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'PictureCategoryController@postDelete']);
        });

        Route::group(['as' => '-pictures', 'prefix' => 'pictures'], function () {
            Route::get('', ['uses' => 'PictureController@getPictures']);
            Route::get('add', ['as' => '-add', 'uses' => 'PictureController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'PictureController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'PictureController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'PictureController@postEdit']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'PictureController@postDelete']);
            Route::post('publish', ['as' => '-publish', 'uses' => 'PictureController@postPublish']);
            Route::post('feature', ['as' => '-feature', 'uses' => 'PictureController@postFeature']);
        });

        Route::group(['as' => '-file_categories', 'prefix' => 'file_categories'], function () {
            Route::get('', ['uses' => 'FileCategoryController@getFileCategories']);
            Route::get('add', ['as' => '-add', 'uses' => 'FileCategoryController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'FileCategoryController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'FileCategoryController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'FileCategoryController@postEdit']);
            Route::post('pages', ['as' => '-pages', 'uses' => 'FileCategoryController@postPages']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'FileCategoryController@postDelete']);
        });

        Route::group(['as' => '-files', 'prefix' => 'files'], function () {
            Route::get('', ['uses' => 'FileController@getFiles']);
            Route::get('add', ['as' => '-add', 'uses' => 'FileController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'FileController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'FileController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'FileController@postEdit']);
            Route::post('publish', ['as' => '-publish', 'uses' => 'FileController@postPublish']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'FileController@postDelete']);
        });

        Route::group(['as' => '-video_categories', 'prefix' => 'video_categories'], function () {
            Route::get('', ['uses' => 'VideoCategoryController@getVideoCategories']);
            Route::get('add', ['as' => '-add', 'uses' => 'VideoCategoryController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'VideoCategoryController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'VideoCategoryController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'VideoCategoryController@postEdit']);
            Route::post('pages', ['as' => '-pages', 'uses' => 'VideoCategoryController@postPages']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'VideoCategoryController@postDelete']);
        });

        Route::group(['as' => '-videos', 'prefix' => 'videos'], function () {
            Route::get('', ['uses' => 'VideoController@getVideos']);
            Route::get('add', ['as' => '-add', 'uses' => 'VideoController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'VideoController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'VideoController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'VideoController@postEdit']);
            Route::post('publish', ['as' => '-publish', 'uses' => 'VideoController@postPublish']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'VideoController@postDelete']);
        });

        Route::group(['as' => '-project_categories', 'prefix' => 'project_categories'], function () {
            Route::get('', ['uses' => 'ProjectCategoryController@getProjectCategories']);
            Route::get('add', ['as' => '-add', 'uses' => 'ProjectCategoryController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'ProjectCategoryController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'ProjectCategoryController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'ProjectCategoryController@postEdit']);
            Route::post('pages', ['as' => '-pages', 'uses' => 'ProjectCategoryController@postPages']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'ProjectCategoryController@postDelete']);
        });

        Route::group(['as' => '-projects', 'prefix' => 'projects'], function () {
            Route::get('', ['uses' => 'ProjectController@getProjects']);
            Route::get('add', ['as' => '-add', 'uses' => 'ProjectController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'ProjectController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'ProjectController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'ProjectController@postEdit']);
            Route::post('publish', ['as' => '-publish', 'uses' => 'ProjectController@postPublish']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'ProjectController@postDelete']);
        });

        Route::group(['as' => '-profiles', 'prefix' => 'profiles'], function () {
            Route::get('', ['uses' => 'ProfileController@getProfiles']);
            Route::get('add', ['as' => '-add', 'uses' => 'ProfileController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'ProfileController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'ProfileController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'ProfileController@postEdit']);
            Route::get('positions', ['as' => '-positions', 'uses' => 'ProfileController@getPositions']);
            Route::post('publish', ['as' => '-publish', 'uses' => 'ProfileController@postPublish']);
            Route::post('feature', [ProfileController::class, 'postFeature'])->name('-feature');
            Route::post('delete', ['as' => '-delete', 'uses' => 'ProfileController@postDelete']);
        });

        Route::group(['as' => '-sermons', 'prefix' => 'sermons'], function () {
            Route::get('', ['uses' => 'SermonController@getSermons']);
            Route::get('add', ['as' => '-add', 'uses' => 'SermonController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'SermonController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'SermonController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'SermonController@postEdit']);
            Route::post('pages', ['as' => '-pages', 'uses' => 'SermonController@postPages']);
            Route::post('publish', ['as' => '-publish', 'uses' => 'SermonController@postPublish']);
            Route::post('picture', ['as' => '-picture', 'uses' => 'SermonController@postPicture']);
            Route::post('audio', ['as' => '-audio', 'uses' => 'SermonController@postAudio']);
            Route::post('video', ['as' => '-video', 'uses' => 'SermonController@postVideo']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'SermonController@postDelete']);
        });

        Route::group(['as' => '-event_categories', 'prefix' => 'event_categories'], function () {
            Route::get('', ['uses' => 'EventCategoryController@getEventCategories']);
            Route::get('add', ['as' => '-add', 'uses' => 'EventCategoryController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'EventCategoryController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'EventCategoryController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'EventCategoryController@postEdit']);
            Route::post('pages', ['as' => '-pages', 'uses' => 'EventCategoryController@postPages']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'EventCategoryController@postDelete']);
        });

        Route::group(['as' => '-events', 'prefix' => 'events'], function () {
            Route::get('', ['uses' => 'EventController@getEvents']);
            Route::get('add', ['as' => '-add', 'uses' => 'EventController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'EventController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'EventController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'EventController@postEdit']);
            Route::post('publish', ['as' => '-publish', 'uses' => 'EventController@postPublish']);
            Route::post('feature', ['as' => '-feature', 'uses' => 'EventController@postFeature']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'EventController@postDelete']);
            Route::group(['prefix' => 'schedules', 'as' => '-schedules'], function () {
                Route::post('delete', ['as' => '-delete', 'uses' => 'EventController@deleteSchedule']);
            });
        });

        Route::group(['middleware' => 'auth:admin', 'as' => '-products', 'prefix' => 'products'], function () {
            Route::get('', ['uses' => 'ProductController@getProducts']);
            Route::get('add', ['as' => '-add', 'uses' => 'ProductController@getAdd']);
            Route::post('add', ['as' => '-add-post', 'uses' => 'ProductController@postAdd']);
            Route::get('edit/{id?}', ['as' => '-edit', 'uses' => 'ProductController@getEdit']);
            Route::post('edit', ['as' => '-edit-post', 'uses' => 'ProductController@postEdit']);
            Route::get('pictures/{id?}', ['as' => '-pictures', 'uses' => 'ProductController@getPictures']);
            Route::post('pictures', ['as' => '-pictures-post', 'uses' => 'ProductController@postPictures']);
            Route::post('pages', ['as' => '-pages', 'uses' => 'ProductController@postPages']);
            Route::post('publish', ['as' => '-publish', 'uses' => 'ProductController@postPublish']);
            Route::post('delete', ['as' => '-delete', 'uses' => 'ProductController@postDelete']);
        });

        Route::name('-tags')->prefix('tags')->group(function () {
            Route::get('', [TagController::class, 'index']);
        });

        Route::get('settings', ['as' => '-settings', 'uses' => 'SettingsController@getSettings']);
        Route::post('settings', ['as' => '-settings-post', 'uses' => 'SettingsController@postSettings']);

        Route::group(['as' => '-setup', 'prefix' => 'setup'], function () {
            Route::get('', ['as' => '', 'uses' => 'SettingsController@getSetup']);
        });
    });
});
