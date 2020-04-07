<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

Route::group(['middleware'=>'web','as'=>'admin','prefix'=>'admin','namespace'=>'Ogilo\AdminMd\Http\Controllers'],function(){

	Route::group(['middleware'=>'guest'],function(){
		Route::get('login',['as'=>'-login','uses'=>'AuthController@getLogin']);
		Route::post('login',['as'=>'-login','uses'=>'AuthController@postLogin']);
	});

	Route::group(['middleware'=>'auth:admin'],function(){
		Route::get('',['as'=>'-dashboard','uses'=>'HomeController@getDashboard']);
		Route::get('logout',['as'=>'-logout','uses'=>'AuthController@getLogout']);
		Route::post('images_upload_url',['as'=>'-images_upload_url','uses'=>'HomeController@postImageUpload']);

		Route::group(['as'=>'-profile','prefix'=>'profile'],function(){
			Route::get('',['uses'=>'AuthController@getProfile']);
			Route::post('',['uses'=>'AuthController@postProfile']);
		});

		Route::group(['as'=>'-password','prefix'=>'password'],function(){
			Route::get('',['uses'=>'AuthController@getPassword']);
			Route::post('',['uses'=>'AuthController@postPassword']);
		});

		Route::group(['as'=>'-options','prefix'=>'options'],function(){
			Route::get('',['uses'=>'OptionsController@getOptions']);
			Route::get('add',['uses'=>'OptionsController@getAdd']);
			Route::post('add',['uses'=>'OptionsController@postAdd']);
			Route::get('edit',['uses'=>'OptionsController@getEdit']);
			Route::post('edit',['uses'=>'OptionsController@postEdit']);
			Route::post('delete',['uses'=>'OptionsController@postDelete']);
		});

		Route::group(['as'=>'-roles','prefix'=>'roles'],function(){
			Route::get('',['uses'=>'RoleController@getRoles']);
			Route::get('add',['as'=>'-add','uses'=>'RoleController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'RoleController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'RoleController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'RoleController@postEdit']);
			Route::post('delete',['as'=>'-delete','uses'=>'RoleController@postDelete']);
		});

		Route::group(['as'=>'-users','prefix'=>'users'],function(){
			Route::get('',['uses'=>'UserController@getUsers']);
			Route::get('add',['as'=>'-add','uses'=>'UserController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'UserController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'UserController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'UserController@postEdit']);
			Route::post('delete',['as'=>'-delete','uses'=>'UserController@postDelete']);
			Route::post('activate',['as'=>'-activate','uses'=>'UserController@postActivate']);
			Route::post('password',['as'=>'-password','uses'=>'UserController@postPassword']);
		});

		Route::group(['as'=>'-menus','prefix'=>'menus'],function(){
			Route::get('',['uses'=>'MenuController@getMenus']);
			Route::get('add',['as'=>'-add','uses'=>'MenuController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'MenuController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'MenuController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'MenuController@postEdit']);
			Route::post('delete',['as'=>'-delete','uses'=>'MenuController@postDelete']);
		});

		Route::group(['as'=>'-links','prefix'=>'links'],function(){
			Route::get('',['uses'=>'LinkController@getLinks']);
			Route::get('add',['as'=>'-add','uses'=>'LinkController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'LinkController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'LinkController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'LinkController@postEdit']);
			Route::post('delete',['as'=>'-delete','uses'=>'LinkController@postDelete']);
			Route::post('order',['as'=>'-order','uses'=>'LinkController@postOrder']);
		});

		Route::group(['as'=>'-pages','prefix'=>'pages'],function(){
			Route::get('',['uses'=>'PageController@getPages']);
			Route::get('add',['as'=>'-add','uses'=>'PageController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'PageController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'PageController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'PageController@postEdit']);
			Route::post('delete',['as'=>'-delete','uses'=>'PageController@postDelete']);
		});

		Route::group(['as'=>'-article_categories','prefix'=>'article_categories'],function(){
			Route::get('',['uses'=>'ArticleCategoryController@getArticleCategories']);
			Route::get('add',['as'=>'-add','uses'=>'ArticleCategoryController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'ArticleCategoryController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'ArticleCategoryController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'ArticleCategoryController@postEdit']);
			Route::post('pages',['as'=>'-pages','uses'=>'ArticleCategoryController@postPages']);
			Route::post('delete',['as'=>'-delete','uses'=>'ArticleCategoryController@postDelete']);
		});

		Route::group(['as'=>'-articles','prefix'=>'articles'],function(){
			Route::get('',['uses'=>'ArticleController@getArticles']);
			Route::get('add',['as'=>'-add','uses'=>'ArticleController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'ArticleController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'ArticleController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'ArticleController@postEdit']);
			Route::post('publish',['as'=>'-publish','uses'=>'ArticleController@postPublish']);
			Route::post('delete',['as'=>'-delete','uses'=>'ArticleController@postDelete']);
		});

		Route::group(['as'=>'-picture_categories','prefix'=>'picture_categories'],function(){
			Route::get('',['uses'=>'PictureCategoryController@getPictureCategories']);
			Route::get('add',['as'=>'-add','uses'=>'PictureCategoryController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'PictureCategoryController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'PictureCategoryController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'PictureCategoryController@postEdit']);
			Route::post('pages',['as'=>'-pages','uses'=>'PictureCategoryController@postPages']);
			Route::post('delete',['as'=>'-delete','uses'=>'PictureCategoryController@postDelete']);
		});

		Route::group(['as'=>'-pictures','prefix'=>'pictures'],function(){
			Route::get('',['uses'=>'PictureController@getPictures']);
			Route::get('add',['as'=>'-add','uses'=>'PictureController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'PictureController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'PictureController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'PictureController@postEdit']);
			Route::post('delete',['as'=>'-delete','uses'=>'PictureController@postDelete']);
			Route::post('publish',['as'=>'-publish','uses'=>'PictureController@postPublish']);
		});

		Route::group(['as'=>'-file_categories','prefix'=>'file_categories'],function(){
			Route::get('',['uses'=>'FileCategoryController@getFileCategories']);
			Route::get('add',['as'=>'-add','uses'=>'FileCategoryController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'FileCategoryController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'FileCategoryController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'FileCategoryController@postEdit']);
			Route::post('pages',['as'=>'-pages','uses'=>'FileCategoryController@postPages']);
			Route::post('delete',['as'=>'-delete','uses'=>'FileCategoryController@postDelete']);
		});

		Route::group(['as'=>'-files','prefix'=>'files'],function(){
			Route::get('',['uses'=>'FileController@getFiles']);
			Route::get('add',['as'=>'-add','uses'=>'FileController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'FileController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'FileController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'FileController@postEdit']);
			Route::post('publish',['as'=>'-publish','uses'=>'FileController@postPublish']);
			Route::post('delete',['as'=>'-delete','uses'=>'FileController@postDelete']);
		});

		Route::group(['as'=>'-video_categories','prefix'=>'video_categories'],function(){
			Route::get('',['uses'=>'VideoCategoryController@getVideoCategories']);
			Route::get('add',['as'=>'-add','uses'=>'VideoCategoryController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'VideoCategoryController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'VideoCategoryController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'VideoCategoryController@postEdit']);
			Route::post('pages',['as'=>'-pages','uses'=>'VideoCategoryController@postPages']);
			Route::post('delete',['as'=>'-delete','uses'=>'VideoCategoryController@postDelete']);
		});

		Route::group(['as'=>'-videos','prefix'=>'videos'],function(){
			Route::get('',['uses'=>'VideoController@getVideos']);
			Route::get('add',['as'=>'-add','uses'=>'VideoController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'VideoController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'VideoController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'VideoController@postEdit']);
			Route::post('publish',['as'=>'-publish','uses'=>'VideoController@postPublish']);
			Route::post('delete',['as'=>'-delete','uses'=>'VideoController@postDelete']);
		});

		Route::group(['as'=>'-project_categories','prefix'=>'project_categories'],function(){
			Route::get('',['uses'=>'ProjectCategoryController@getProjectCategories']);
			Route::get('add',['as'=>'-add','uses'=>'ProjectCategoryController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'ProjectCategoryController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'ProjectCategoryController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'ProjectCategoryController@postEdit']);
			Route::post('pages',['as'=>'-pages','uses'=>'ProjectCategoryController@postPages']);
			Route::post('delete',['as'=>'-delete','uses'=>'ProjectCategoryController@postDelete']);
		});

		Route::group(['as'=>'-projects','prefix'=>'projects'],function(){
			Route::get('',['uses'=>'ProjectController@getProjects']);
			Route::get('add',['as'=>'-add','uses'=>'ProjectController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'ProjectController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'ProjectController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'ProjectController@postEdit']);
			Route::post('publish',['as'=>'-publish','uses'=>'ProjectController@postPublish']);
			Route::post('delete',['as'=>'-delete','uses'=>'ProjectController@postDelete']);
		});

		Route::group(['as'=>'-profiles','prefix'=>'profiles'],function(){
			Route::get('',['uses'=>'ProfileController@getProfiles']);
			Route::get('add',['as'=>'-add','uses'=>'ProfileController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'ProfileController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'ProfileController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'ProfileController@postEdit']);
			Route::get('positions',['as'=>'-positions','uses'=>'ProfileController@getPositions']);
			Route::post('publish',['as'=>'-publish','uses'=>'ProfileController@postPublish']);
			Route::post('delete',['as'=>'-delete','uses'=>'ProfileController@postDelete']);
		});

		Route::group(['as'=>'-sermons','prefix'=>'sermons'],function(){
			Route::get('',['uses'=>'SermonController@getSermons']);
			Route::get('add',['as'=>'-add','uses'=>'SermonController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'SermonController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'SermonController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'SermonController@postEdit']);
			Route::post('pages',['as'=>'-pages','uses'=>'SermonController@postPages']);
			Route::post('publish',['as'=>'-publish','uses'=>'SermonController@postPublish']);
			Route::post('picture',['as'=>'-picture','uses'=>'SermonController@postPicture']);
			Route::post('audio',['as'=>'-audio','uses'=>'SermonController@postAudio']);
			Route::post('video',['as'=>'-video','uses'=>'SermonController@postVideo']);
			Route::post('delete',['as'=>'-delete','uses'=>'SermonController@postDelete']);
		});

		Route::group(['as'=>'-event_categories','prefix'=>'event_categories'],function(){
			Route::get('',['uses'=>'EventCategoryController@getEventCategories']);
			Route::get('add',['as'=>'-add','uses'=>'EventCategoryController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'EventCategoryController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'EventCategoryController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'EventCategoryController@postEdit']);
			Route::post('pages',['as'=>'-pages','uses'=>'EventCategoryController@postPages']);
			Route::post('delete',['as'=>'-delete','uses'=>'EventCategoryController@postDelete']);
		});

		Route::group(['as'=>'-events','prefix'=>'events'],function(){
			Route::get('',['uses'=>'EventController@getEvents']);
			Route::get('add',['as'=>'-add','uses'=>'EventController@getAdd']);
			Route::post('add',['as'=>'-add','uses'=>'EventController@postAdd']);
			Route::get('edit/{id?}',['as'=>'-edit','uses'=>'EventController@getEdit']);
			Route::post('edit',['as'=>'-edit-post','uses'=>'EventController@postEdit']);
			Route::post('publish',['as'=>'-publish','uses'=>'EventController@postPublish']);
			Route::post('delete',['as'=>'-delete','uses'=>'EventController@postDelete']);
		});

		Route::group(['middleware'=>'auth:admin','as'=>'-products','prefix'=>'products'],function(){
            Route::get('',['uses'=>'ProductController@getProducts']);
            Route::get('add',['as'=>'-add','uses'=>'ProductController@getAdd']);
            Route::post('add',['as'=>'-add','uses'=>'ProductController@postAdd']);
            Route::get('edit/{id?}',['as'=>'-edit','uses'=>'ProductController@getEdit']);
            Route::post('edit',['as'=>'-edit-post','uses'=>'ProductController@postEdit']);
            Route::get('pictures/{id?}',['as'=>'-pictures','uses'=>'ProductController@getPictures']);
            Route::post('pictures',['as'=>'-pictures-post','uses'=>'ProductController@postPictures']);
            Route::post('pages',['as'=>'-pages','uses'=>'ProductController@postPages']);
            Route::post('publish',['as'=>'-publish','uses'=>'ProductController@postPublish']);
            Route::post('delete',['as'=>'-delete','uses'=>'ProductController@postDelete']);
        });

		Route::get('settings',['as'=>'-settings','uses'=>'SettingsController@getSettings']);
		Route::post('settings',['as'=>'-settings','uses'=>'SettingsController@postSettings']);

		Route::get('migrate/{key}',function($key){
			if($setupkey = config('setup.key')){
				if(Hash::check($key,$setupkey)){
					Artisan::call('migrate',[
						'--step'=>true
					]);
					return '<pre>'.Artisan::output().'</pre>';
				}else{
					return response('Page Not found',404);
				}
			}else{
				if($key){
					$fp = fopen(config_path('setup.php') , 'w');
					fwrite($fp, '<?php return ' . var_export(['key'=>Hash::make($key)], true) . ';');
					fclose($fp);
				}
			}
		});
	});

});
