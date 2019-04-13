<?php 

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\Sermon;

use Validator;
use Img;

/**
* Sermons Controller
*/
class SermonController extends Controller {

	/**
	 * List Sermons
	 */
	public function getSermons($value='')
	{
		$sermons = Sermon::all();
		return view('admin::sermons.index',compact('sermons'));
	}

	public function getAdd()
	{
		// abort(500,"internal server error");
		return view('admin::sermons.add');
	}

	public function postAdd(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'title'=>'required|unique:sermons,title',
				'picture'=>'required|image',
			]);

		if($validator->fails()){
			return redirect()
					->back()
					->withErrors($validator)
					->withInput()
					->with('global-warning','Some fields failed validation. Please check and try again');
		}

		$sermon = new Sermon;

		if ($request->hasFile('picture')) {
			$file = $request->file('picture');

			if ($file->isValid()) {
				$image = Img::make($file->getRealPath());

				$dir = public_path('images/sermons/');
				if (!file_exists($dir)) {
					mkdir($dir,0755,TRUE);
				}
				$filename = time().'.jpg';
				$image->save($dir.$filename);

				$thumbnail = Img::make($file->getRealPath());
				$dir = public_path('images/sermons/thumbnails/');
				if (!file_exists($dir)) {
					mkdir($dir,0755,TRUE);
				}
				$thumbnail->fit(256,256);
				$thumbnail->save($dir.$filename);

				$sermon->picture = $filename;
			}
		}

		$sermon->name 		= str_slug($request->input('title'));
		$sermon->title 		= $request->input('title');
		$sermon->content 	= $request->input('content');
		$sermon->sermon_by 	= $request->input('sermon_by');
		$sermon->sermon_at 	= $request->input('sermon_date');

		$sermon->save();

		$sermon->pages()->attach($request->input('pages'));

		return redirect()
				->route('admin-sermons')
				->with('global-success','Sermon successfuly created');

	}

	public function postPicture(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'id'=>'bail|required',
				'picture'=>'required|image',
			]);

		if($validator->fails()){
			return redirect()
					->back()
					->withErrors($validator)
					->withInput()
					->with('global-warning','Some fields failed validation. Please check and try again');
		}

		$sermon = Sermon::find($request->input('id'));

		if ($request->hasFile('picture')) {
			$file = $request->file('picture');

			if ($file->isValid()) {
				$image = Img::make($file->getRealPath());

				$dir = public_path('images/sermons/');
				if (!file_exists($dir)) {
					mkdir($dir,0755,TRUE);
				}
				$filename = time().'.jpg';
				$image->save($dir.$filename);

				$thumbnail = Img::make($file->getRealPath());
				$dir = public_path('images/sermons/thumbnails/');
				if (!file_exists($dir)) {
					mkdir($dir,0755,TRUE);
				}
				$thumbnail->fit(256,256);
				$thumbnail->save($dir.$filename);

				$sermon->picture = $filename;
			}
		}

		$sermon->save();

		return redirect()
				->back()
				->with('global-success','Audio file for sermon uploaded');

	}

	public function postAudio(Request $request)
	{
		// dd($request->file('audio')->clientExtension());
		$validator = Validator::make($request->all(),[
				'id'=>'bail|required',
				'audio'=>'required'// |mimes:mpga,wav',
			],[
				//'audio.mimetypes'=>'This is not a valid audo file',
			]);

		if($validator->fails()){
			return redirect()
					->back()
					->withErrors($validator)
					->withInput()
					->with('global-warning','Some fields failed validation. Please check and try again');
		}

		$sermon = Sermon::find($request->input('id'));

		$file = $request->file('audio');

		$dir = public_path('audio/sermons/');
		if (!file_exists($dir)) {
			mkdir($dir,0755,TRUE);
		}

		if (file_exists($old = public_path('audio/sermons/'.$sermon->audio))) {
			if(!is_dir($old))
				unlink($old);
		}

		$filename = time().'.'.$file->clientExtension();

		$file->move($dir,$filename);

		$sermon->audio = $filename;

		$sermon->save();

		return redirect()
				->back()
				->with('global-success','Audio file for sermon uploaded');
	}

	public function postVideo(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'id'=>'bail|required',
				'video'=>'required|mimetypes:video/avi,video/mkv,video/mp4',
			],[
				'video.mimetypes'=>'This is not a valid video clip',
			]);

		if($validator->fails()){
			return redirect()
					->back()
					->withErrors($validator)
					->withInput()
					->with('global-warning','Some fields failed validation. Please check and try again');
		}

		$sermon = Sermon::find($request->input('id'));

		// dd($sermon);

		$file = $request->file('video');

		$dir = public_path('video/sermons/');
		if (!file_exists($dir)) {
			mkdir($dir,0755,TRUE);
		}

		if (file_exists($old = public_path('video/sermons/'.$sermon->video))) {
			if(!is_dir($old))
				unlink($old);
		}

		$filename = time().'.'.$file->clientExtension();

		$file->move($dir,$filename);

		$sermon->video = $filename;

		$sermon->save();

		return redirect()
				->back()
				->with('global-success','Video clip uploaded');
	}

	public function getEdit($id)
	{
		$sermon = Sermon::find($id);
		return view('admin::sermons.edit',compact('sermon'));
	}

	public function postEdit(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'id' 		=> 'bail|required|integer',
				'title'		=>'required|unique:sermons,title,'.$request->input('id'),
				'picture'	=>'image',
			]);

		if($validator->fails()){
			return redirect()
					->back()
					->withErrors($validator)
					->withInput()
					->with('global-warning','Some fields failed validation. Please check and try again');
		}

		$sermon = Sermon::find($request->input('id'));

		if ($request->hasFile('picture')) {
			$file = $request->file('picture');

			if ($file->isValid()) {
				$image = Img::make($file->getRealPath());

				$dir = public_path('images/sermons/');
				if (!file_exists($dir)) {
					mkdir($dir,0755,TRUE);
				}
				$filename = time().'.jpg';
				if(file_exists($dir.$sermon->picture))
					unlink($dir.$sermon->picture);
				$image->save($dir.$filename);

				$thumbnail = Img::make($file->getRealPath());
				$dir = public_path('images/sermons/thumbnails/');
				if (!file_exists($dir)) {
					mkdir($dir,0755,TRUE);
				}

				if( file_exists($dir.$sermon->picture) )
					unlink($dir.$sermon->picture);

				$thumbnail->fit(256,256);
				$thumbnail->save($dir.$filename);

				$sermon->picture = $filename;
			}
		}

		$sermon->name 		= str_slug($request->input('title'));
		$sermon->title 		= $request->input('title');
		$sermon->content 	= $request->input('content');
		$sermon->sermon_by 	= $request->input('sermon_by');
		$sermon->sermon_at 	= $request->input('sermon_date');

		$sermon->save();

		$sermon->pages()->detach($sermon->pageIds());
		$sermon->pages()->attach($request->input('pages'));

		return redirect()
				->route('admin-sermons')
				->with('global-success','Sermon successfuly updated');
	}

	public function postPublish(Request $request)
	{
		$sermon = Sermon::find($request->input('id'));
		$sermon->published = !$sermon->published;
		$sermon->save();

		return response(['message'=>$sermon->published ? 'Sermon has been publisjed' : 'Sermon has been un-published'])
				->header('Content-Type','application/json');
	}
}