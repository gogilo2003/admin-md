<?php

namespace Ogilo\AdminMd\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\Page;
use Ogilo\AdminMd\Models\Article;
use Ogilo\AdminMd\Models\Sermon;
use Ogilo\AdminMd\Models\Profile;
use Ogilo\AdminMd\Models\Package;
use Ogilo\AdminMd\Models\Event;
use Ogilo\AdminMd\Models\Guest;
use Ogilo\AdminMd\Models\Comment;

use Validator;

/**
*
*/
class PagesController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest');
	}

	public function getPage($page_name='home')
	{
		// dd($page_name);

		if($page = Page::with([
			'article_categories.articles'=>function($query){
				return $query->where('published','=',1);
			},
			'picture_categories.pictures'=>function($query){
				return $query->where('published','=',1);
			},
			'video_categories.videos'=>function($query){
				return $query->where('published','=',1);
			},
			'file_categories.files'=>function($query){
				return $query->where('published','=',1);
			},
			'project_categories.projects'=>function($query){
				return $query->where('published','=',1);
			},
			'element_categories.elements'=>function($query){
				return $query->where('published','=',1);
			},
			'event_categories.events'=>function($query){
				return $query->where('published','=',1)->orderBy('held_at','ASC');
			},
			'profiles'=>function($query){
				return $query->where('published','=',1);
			},
			'sermons'=>function($query){
				return $query->where('published','=',1);
			}
			])->where('name','=',$page_name)->first()){

			// dd(json_encode($page));

			$template = file_exists(resource_path('views/'.$page_name.'.blade.php'))? $page_name : ( file_exists(resource_path('views/web/'.$page_name.'.blade.php')) ? 'web.'.$page_name :'admin::web.home');
			// dd(resource_path('views/web/'.$page_name.'.blade.php'));
			return view($template,compact('page'));

		}else{
			return abort(404);
		}
	}

	public function getArticle($article_name,$page_name=null)
	{
		// dd($page_name);

		$article = Article::with('category.pages')->where('name','=',$article_name)->first() ;

		$template = file_exists(resource_path('views/web/article.blade.php')) ? 'web.article' :'admin::web.article';

		$page = $page_name ? Page::with('link')->where('name','=',$page_name)->first() : $article->category->pages->first();

		// dd($page->link);

		return view($template,compact('article','page'));
	}

	public function getSermon($sermon_name,$page_name=null)
	{

		$sermon = Sermon::where('name','=',$sermon_name)->first();

		// dd($sermon->pages);

		$sermon = $sermon ? $sermon : Sermon::where('name','=',$page_name)->first() ;

		$template = file_exists(resource_path('views/web/sermon.blade.php')) ? 'web.sermon' :'admin::web.sermon';

		$page = $page_name ? $sermon->pages->where('name','=',$page_name)->first() : $sermon->pages->first();

		return view($template,compact('sermon','template','page'));
	}

	public function getProfile($profile_name,$page_name=null)
	{

		$profile = Profile::where('id','=',$profile_name)->first();

		// dd($profile);

		$profile = $profile ? $profile : Profile::where('name','=',$page_name)->first() ;

		$template = file_exists(resource_path('views/web/profile.blade.php')) ? 'web.profile' :'admin::web.profile';

		$page = $page_name ? $profile->pages->where('name','=',$page_name)->first() : $profile->pages->first();

		return view($template,compact('profile','template','page'));
	}
    
    public function getPackage($package_name,$page_name=null)
	{

		$package = Package::where('title','=',$package_name)->first();

		// dd($package);

		$package = $package ? $package : Package::where('title','=',$package_name)->first() ;

		$template = file_exists(resource_path('views/web/package.blade.php')) ? 'web.package' : (file_exists(resource_path('views/package.blade.php')) ? 'package' : 'admin::web.package');

		$page = $page_name ? $package->pages->where('name','=',$page_name)->first() : $package->pages->first();

		return view($template,compact('package','template','page'));
	}

	public function getEvent($event_name,$page_name=null)
	{

		$event = Event::where('name','=',$event_name)->first();

		// dd($event->pages);

		$event = $event ? $event : Event::where('name','=',$page_name)->first() ;

		$template = file_exists(resource_path('views/web/event.blade.php')) ? 'web.event' :'admin::web.event';

		$page = $page_name ? $event->pages->where('name','=',$page_name)->first() : $event->pages->first();

		$events = Event::where('published','=',1)->orderBy('held_at','DESC')->get();

		return view($template,compact('events', 'event','template','page'));
	}

	public function postEventGuest(Request $request)
	{
		// dd($request->all());

		$validator = Validator::make($request->all(),[
				'first_name' => 'required',
				'last_name' => 'required',
				'phone_number' => 'required',
				'email' => 'required|email',
			]);

		if ($validator->fails()) {
			return redirect()
					->back()
					->with('error','Some fields failed validation. Please check and try again');
		}

		$guest = new Guest;

		$guest->event_id = $request->input('event_id');
		$guest->first_name = $request->input('first_name');
		$guest->last_name = $request->input('last_name');
		$guest->phone_number = $request->input('phone_number');
		$guest->email = $request->input('email');

		$guest->save();

		return redirect()
				->back()
				->with('message','You have successfuly registered for the event');
	}

	public function postComment(Request $request)
	{
		// dd($request->all());

		$validator = Validator::make($request->all(),[
				'name' => 'required',
				'email' => 'required|email',
				'message' => 'required',
			]);

		if ($validator->fails()) {
			return redirect()
					->back()
					->with('error','Some fields failed validation. Please check and try again');
		}

		$comment = new Comment;

		$comment->article_id = $request->input('article_id');
		$comment->name = $request->input('name');
		$comment->email = $request->input('email');
		$comment->website = $request->input('website');
		$comment->message = $request->input('message');

		$comment->save();

		return redirect()
				->back()
				->with('message','You have successfuly posted a comment');
	}

	public function postContact(Request $request)
	{
		// dd($request->all());
		$name=$cust_name=null;
		$email=null;
		$email_to_send_to=null;
		$comment=null;
		$cphn=null;
		$email_subject = null;
		$body=null;

		if($request->input('formid')=='contact')
		{
			$name=$cust_name=$request->input('name');
			$email=$request->input('email');
			$email_to_send_to=config('admin.contact');
			$comment=$request->input('comments');
			$cphn=$request->input('phone');
			$email_subject = "Website Contact - " .$request->input('subject');
			$body='Contact Name :'.$name.'<br>'.'Contact Email:'.$email.'<br>'.'Contact Phone:'.$cphn.'<br>'.'Comment:'.$comment;
		}

		$headers= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers.= 'From: '.$name.'<'.$email.'> ' . "\r\n" .'Reply-To: '.$email.' ' . "\r\n" .'X-Mailer: PHP/' . phpversion();

		$ret = @mail($email_to_send_to,$email_subject,$body,$headers);

		dd($ret);

		if(!$ret){
			return response(['success'=>false,'message'=>'Email Could not be sent due to a server problem. Please check back later'])->header('Content-Type','application/json');
		}else{
			return response(['success'=>true,'message'=>'Email sent successfully!'])->header('Content-Type','application/json');
		}
	}

}
