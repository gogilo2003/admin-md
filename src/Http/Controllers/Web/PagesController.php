<?php

namespace Ogilo\AdminMd\Http\Controllers\Web;

// use Mail;
use Illuminate\Http\Request;
use Ogilo\AdminMd\Models\File;
use Ogilo\AdminMd\Models\Page;
use Ogilo\AdminMd\Models\Event;
use Ogilo\AdminMd\Models\Guest;
use Ogilo\AdminMd\Models\Sermon;
use Ogilo\AdminMd\Models\Article;
use Ogilo\AdminMd\Models\Comment;
use Ogilo\AdminMd\Models\Profile;
use Ogilo\AdminMd\Mail\WebFeedback;
use Illuminate\Support\Facades\Mail;
use Ogilo\AdminMd\Models\CommentUser;
use Illuminate\Support\Facades\Validator;
use Ogilo\AdminMd\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getPage($page_name = 'home')
    {
        if ($page = Page::with([
            'article_categories.articles' => function ($query) {
                return $query->where('published', '=', 1);
            },
            'picture_categories.pictures' => function ($query) {
                return $query->where('published', '=', 1);
            },
            'video_categories.videos' => function ($query) {
                return $query->where('published', '=', 1);
            },
            'file_categories.files' => function ($query) {
                return $query->where('published', '=', 1);
            },
            'project_categories.projects' => function ($query) {
                return $query->where('published', '=', 1);
            },
            'element_categories.elements' => function ($query) {
                return $query->where('published', '=', 1);
            },
            'event_categories.events' => function ($query) {
                return $query->where('published', '=', 1)->orderBy('held_at', 'ASC');
            },
            'profiles' => function ($query) {
                return $query->where('published', '=', 1);
            },
            'sermons' => function ($query) {
                return $query->where('published', '=', 1);
            },
        ])->where('name', '=', $page_name)->first()) {
            return view()->first([$page_name, 'web.' . $page_name, 'admin::web.' . $page_name, 'admin::web.home'], compact('page'));
        } else {
            $page = new Page();
            $page->title = 'Missing page/template';
            $page->content = "<div class=\"container\"><h1>This page has not been created</h1><p>The page you are looking for has not been created. You can go to admin and add a page with the name <code>$page_name</code> and then proceed to templates and create a template in <code>" . \resource_path('views') . '</code> or <code>' . \resource_path('views/web') . "</code> folder named <code>$page_name.blade.php</code></p><p>You can also quickly run the artisan command <br><code>php artisan admin:make-page $page_name</code></p><p>Usage <br><img src=\"" . file_get_contents(realpath(__DIR__ . '/../../../../resources/data/missing-page.txt')) . "\"></p></div>";

            return view('welcome', compact('page'));
        }
    }

    public function getArticle($article_name, $page_name = null)
    {
        $article = Article::with(['author', 'category.pages', 'comments' => function ($query) {
            return $query->where('published', 1)->where('parent_comment_id', null)->orderBy('created_at', 'DESC')->get();
        }])->where('name', '=', $article_name)->first();

        $page = $page_name ? Page::with('link')->where('name', '=', $page_name)->first() : ($article->category->pages->first() ?? Page::get()->first());

        // $template = file_exists(resource_path('views/web/article.blade.php')) ? 'web.article' :'admin::web.article';

        return view()->first([
            'web.article.' . $article->category->name,
            'article.' . $article->category->name,
            'web.article.article',
            'article.article',
            'admin::web.article',
            'web.article',
            'article'
        ], compact('article', 'page'));
    }

    public function getSermon($sermon_name, $page_name = null)
    {
        $sermon = Sermon::where('name', '=', $sermon_name)->first();

        $sermon = $sermon ? $sermon : Sermon::where('name', '=', $page_name)->first();

        $page = $page_name ? $sermon->pages->where('name', '=', $page_name)->first() : $sermon->pages->first();

        // $template = file_exists(resource_path('views/web/sermon.blade.php')) ? 'web.sermon' :'admin::web.sermon';

        return view()->first(['web.sermon', 'sermon', 'admin::web.sermon'], compact('sermon', 'template', 'page'));
    }

    public function getProfile($profile_name, $page_name = null)
    {
        $profile = Profile::where('id', '=', $profile_name)->first();

        // dd($profile);

        $profile = $profile ? $profile : Profile::where('name', '=', $page_name)->first();

        $page = $page_name ? $profile->pages->where('name', '=', $page_name)->first() : $profile->pages->first();

        // $template = file_exists(resource_path('views/web/profile.blade.php')) ? 'web.profile' :'admin::web.profile';

        return view()->first(['web.profile', 'profile', 'admin::web.profile'], compact('profile', 'page'));
    }

    public function getEvent($event_name, $page_name = null)
    {
        $event = Event::where('name', '=', $event_name)->first();

        // dd($event->pages);

        $event = $event ? $event : Event::where('name', '=', $page_name)->first();

        $page = $page_name ? $event->pages->where('name', '=', $page_name)->first() : $event->pages->first();

        $events = Event::where('published', '=', 1)->orderBy('held_at', 'DESC')->get();

        // $template = file_exists(resource_path('views/web/event.blade.php')) ? 'web.event' :'admin::web.event';

        return view()->first(['web.event', 'event', 'admin::web.event'], compact('events', 'event', 'page'));
    }

    public function postEventGuest(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('error', 'Some fields failed validation. Please check and try again');
        }

        $guest = new Guest();

        $guest->event_id = $request->input('event_id');
        $guest->first_name = $request->input('first_name');
        $guest->last_name = $request->input('last_name');
        $guest->phone_number = $request->input('phone_number');
        $guest->email = $request->input('email');

        $guest->save();

        return redirect()
            ->back()
            ->with('message', 'You have successfully registered for the event');
    }

    public function postComment(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'article_id' => 'required|exists:articles,id',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('error', 'Some fields failed validation. Please check and try again');
        }

        $user = CommentUser::where('email', $request->email)->first();

        if (!$user) {
            $user = new CommentUser();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->website = $request->website;
            $user->save();
        }

        $comment = new Comment();

        $comment->article_id = $request->input('article_id');
        $comment->user_id = $user->id;
        $comment->message = $request->input('message');

        $comment->save();

        return redirect()
            ->back()
            ->with('message', 'You have successfully posted a comment');
    }

    public function postContact(Request $request)
    {
        $data = $request->except('_token');
        // return (new WebFeedback($data))->render();
        try {
            Mail::send(new WebFeedback($data));

            return response(['success' => true, 'message' => 'Email sent successfully!'])->header('Content-Type', 'application/json');
        } catch (\Exception $e) {
            return response(['success' => false, 'message' => 'Email Could not be sent due to a server problem. Please check back later', 'details' => $e->getMessage()])->header('Content-Type', 'application/json');
        }
    }

    public function downlodFile($id)
    {
        $file = File::find($id);
        $path = public_path('files/' . $file->name);
        $name = $file->title . '.' . get_file_extension($file->name);

        return response()->download($path, $name);
    }

    public function getFile($file_id, $page_name = null)
    {
        $file = File::with('category.pages')->find($file_id);

        $page = $page_name ? Page::with('link')->where('name', '=', $page_name)->first() : $file->category->pages->first();

        return view()->first(['web.file', 'file', 'admin::web.file'], compact('file', 'page'));
    }
}
