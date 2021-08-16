<?php

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\Article;
use Ogilo\AdminMd\Models\ArticleCategory;
use Ogilo\AdminMd\Models\Page;

use Validator;
use Img;

/**
 *
 */
class BlogController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function getBlogs()
	{
		$cat = ArticleCategory::where('name', 'blog')
			->orWhere('name', 'blogs')
			->with(['articles' => function ($query) {
				return $query->orderBy('id', 'DESC')->get();
			}, 'articles.comments'])->first();

		$blogs = $cat ? $cat->articles : [];

		return view('admin::blogs.index', compact('blogs'));
	}

	public function getAdd()
	{
		return view('admin::blogs.add');
	}

	public function postAdd(Request $request)
	{
		// dd($request->all());
		$validator = Validator::make($request->all(), [
			'title'		=> 'required|unique:articles,title,null,id,article_category_id,' . $request->input('category'),
			'content'	=> 'required',
			'category'	=> 'integer',
			'picture'	=> 'image',
		]);

		if ($validator->fails()) {
			return redirect()
				->back()
				->withInput()
				->withErrors($validator)
				->with('global-warning', 'Some fields failed validation, please check and try again');
		}

		$article = new Article;

		if ($request->hasFile('picture')) {
			$picture = $request->file('picture');

			$dir = public_path('images/articles/');
			if (!file_exists($dir)) {
				mkdir($dir, 0755, true);
			}

			$image = Img::make($picture->getRealPath());

			$cropdetails = json_decode($request->input('image_cropdetails'));
			$image->crop((int)$cropdetails->width, (int)$cropdetails->height, (int)$cropdetails->x, (int)$cropdetails->y)->resize(640, 480);

			$filename = time() . '.' . $picture->guessClientExtension();
			$image->save($dir . $filename);
			$image->destroy();

			if (!file_exists($dir . '160x160/')) {
				mkdir($dir . '160x160/', 0755, true);
			}

			$square = Img::make($picture->getRealPath());
			$square->fit(160, 160);
			$square->save($dir . '160x160/' . $filename);
			$square->destroy();

			if (!file_exists($dir . '512x512/')) {
				mkdir($dir . '512x512/', 0755, true);
			}

			$square_hd = Img::make($picture->getRealPath());
			$square_hd->fit(512, 512);
			$square_hd->save($dir . '512x512/' . $filename);
			$square_hd->destroy();

			if (!file_exists($dir . '480x240/')) {
				mkdir($dir . '480x240/', 0755, true);
			}

			$rectangle 	= Img::make($picture->getRealPath());
			$rectangle->fit(480, 240);
			$rectangle->save($dir . '480x240/' . $filename);
			$rectangle->destroy();

			if (!file_exists($dir . 'originals/')) {
				mkdir($dir . 'originals/', 0755, true);
			}

			$original 	= Img::make($picture->getRealPath());
			$original->save($dir . 'originals/' . $filename);
			$original->destroy();

			$article->picture = $filename;
		}

		$article->name 		= str_slug_unique('articles', 'name', $request->input('title'));
		$article->title 	= $request->input('title');
		$article->icon 		= $request->input('icon');
		$article->content 	= $request->input('content');

		$category 	= ArticleCategory::where('name', 'blog')
			->orWhere('name', 'blogs')->first();

		$category->articles()->save($article);

		return redirect()
			->route('admin-blogs')
			->with('global-success', 'Blog added');
	}

	public function getView($id)
	{
		$blog = Article::with(['comments' => function ($query) {
			return $query->where('parent_comment_id', null)
				->orderBy('created_at', 'DESC')
				->get();
		}])->findOrFail($id);
		return view('admin::blogs.view', compact('blog'));
	}

	public function getEdit($id)
	{
		$article = Article::findOrFail($id);
		return view('admin::blogs.edit', compact('article'));
	}

	public function postEdit(Request $request)
	{
		// dd($request->all());

		$id = $request->input('id');

		$validator = Validator::make($request->all(), [
			'id'		=> 'required|integer',
			'title'		=> 'required|unique:articles,title,' . $id . ',id,article_category_id,' . $request->input('category'),
			'content'	=> 'required',
			'picture'	=> 'image',
		]);

		if ($validator->fails()) {
			return redirect()
				->back()
				->withInput()
				->withErrors($validator)
				->with('global-warning', 'Some fields failed validation, please check and try again');
		}

		$article = Article::find($id);

		if ($request->hasFile('picture')) {

			$picture = $request->file('picture');

			$image = Img::make($picture->getRealPath());

			$cropdetails = json_decode($request->input('image_cropdetails'));
			$image->crop((int)$cropdetails->width, (int)$cropdetails->height, (int)$cropdetails->x, (int)$cropdetails->y)->resize(640, 480);

			$dir = public_path('images/articles/');
			if (!file_exists($dir)) {
				mkdir($dir, 0755, true);
			}

			if ($article->picture->filename && file_exists($dir . $article->picture->filename)) {
				unlink($dir . $article->picture->filename);
			}

			// $filename = $article->picture->filename ? $article->picture->filename : time().'.jpg';
			$filename = time() . '.' . $picture->guessClientExtension();
			$image->save($dir . $filename);
			$image->destroy();

			if ($article->picture->filename && file_exists($dir . '160x160/' . $article->picture->filename)) {
				unlink($dir . '160x160/' . $article->picture->filename);
			}

			if (!file_exists($dir . '160x160/')) {
				mkdir($dir . '160x160/', 0755, true);
			}

			$square = Img::make($picture->getRealPath());
			$square->fit(160, 160);
			$square->save($dir . '160x160/' . $filename);
			$square->destroy();

			if ($article->picture->filename && file_exists($dir . '512x512/' . $article->picture->filename)) {
				unlink($dir . '512x512/' . $article->picture->filename);
			}


			if (!file_exists($dir . '512x512/')) {
				mkdir($dir . '512x512/', 0755, true);
			}

			$square_hd = Img::make($picture->getRealPath());
			$square_hd->fit(512, 512);
			$square_hd->save($dir . '512x512/' . $filename);
			$square_hd->destroy();

			if ($article->picture->filename && file_exists($dir . '480x480/' . $article->picture->filename)) {
				unlink($dir . '480x480/' . $article->picture->filename);
			}


			if (!file_exists($dir . '480x240/')) {
				mkdir($dir . '480x240/', 0755, true);
			}

			$rectangle 	= Img::make($picture->getRealPath());
			$rectangle->fit(480, 240);
			$rectangle->save($dir . '480x240/' . $filename);
			$rectangle->destroy();

			if ($article->picture->filename && file_exists($dir . 'originals/' . $article->picture->filename)) {
				unlink($dir . 'originals/' . $article->picture->filename);
			}

			if (!file_exists($dir . 'originals/')) {
				mkdir($dir . 'originals/', 0755, true);
			}

			$original 	= Img::make($picture->getRealPath());
			$original->save($dir . 'originals/' . $filename);
			$original->destroy();

			$article->picture = $filename;
		}

		$article->name 					= str_slug_unique('articles', 'name', $request->input('title'), $request->input('id'));
		$article->title 				= $request->input('title');
		$article->icon 					= $request->input('icon');
		$article->content 				= $request->input('content');
		// $article->article_category_id 	= $request->input('category');

		$article->save();

		return redirect()
			->route('admin-articles')
			->with('global-success', 'Article ' . $article->name . ' Updated');
	}

	public function postPublish(Request $request)
	{
		// dd($request->all());

		$article = Article::findOrFail($request->input('id'));
		$article->published = $article->published ? 0 : 1;
		$name = $article->title;
		$article->save();

		return response(["success" => true, "message" => "Article $name " . ($article->published ? "Published" : "Un published") . " successfuly", "published" => $article->published])
			->header('Content-Type', 'application/json');

		// return redirect()
		// 		->route('admin-articles')
		// 		->with('global-success','Article '.$name.' Deleted');
	}

	public function postFeature(Request $request)
	{
		// dd($request->all());

		$article = Article::findOrFail($request->input('id'));
		$article->featured = $article->featured ? 0 : 1;
		$name = $article->title;
		$article->save();

		return response(["success" => true, "message" => "Article $name " . ($article->featured ? "Featured" : "Un featured") . " successfuly", "featured" => $article->featured])
			->header('Content-Type', 'application/json');

		// return redirect()
		// 		->route('admin-articles')
		// 		->with('global-success','Article '.$name.' Deleted');
	}

	public function postDelete(Request $request)
	{
		// dd($request->all());

		$article = Article::findOrFail($request->input('id'));
		$name = $article->name;
		$article->delete();

		return response(["message" => "Article $name Deleted"])
			->header('Content-Type', 'application/json');

		// return redirect()
		// 		->route('admin-articles')
		// 		->with('global-success','Article '.$name.' Deleted');
	}
}
