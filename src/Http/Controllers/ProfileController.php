<?php

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\Profile;

use Validator;
use Img;

/**
 * ProfileController
 */
class ProfileController extends Controller
{

    function getProfiles()
    {
        $profiles = Profile::all();
        return view('admin::profiles.index', compact('profiles'));
    }

    public function getAdd()
    {
        return view('admin::profiles.add');
    }

    public function postAdd(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'position' => 'required',
            'picture' => 'image',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('global-warning', 'Some fields faild validation');
        }

        $profile = new Profile;

        $profile->name        = $request->input('name');
        $profile->position = $request->input('position');
        $profile->facebook = $request->input('facebook');
        $profile->twitter  = $request->input('twitter');
        $profile->youtube  = $request->input('youtube');
        $profile->dribble  = $request->input('dribble');
        $profile->linkedin  = $request->input('linkedin');
        $profile->phone  = $request->input('phone');
        $profile->email  = $request->input('email');
        $profile->box_no  = $request->input('box_no');
        $profile->post_code  = $request->input('post_code');
        $profile->town  = $request->input('town');
        $profile->address  = $request->input('address');
        $profile->details  = $request->input('details');

        if ($request->hasFile('picture')) {
            $image = Img::make($request->file('picture')->getRealPath());
            // $image->fit(359, 244);
            $img = json_decode($request->input('image_cropdetails'));
            $image->crop((int) $img->width, (int) $img->height, (int) $img->x, (int) $img->y);

            $dir = public_path('images/profiles/');
            if (!file_exists($dir)) {
                mkdir($dir, 0755, TRUE);
            }
            $filename = time() . '.jpg';

            $profile->picture = $filename;
            $image->save($dir . $filename);
        }

        $profile->save();

        $profile->pages()->attach($request->input('pages'));

        return redirect()
            ->route('admin-profiles')
            ->with('global-success', 'Profile added successfuly');
    }

    public function getEdit($id)
    {
        $profile = Profile::find($id);
        return view('admin::profiles.edit', compact('profile'));
    }

    public function postEdit(Request $request)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'position' => 'required',
            'picture' => 'image',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('global-warning', 'Some fields faild validation');
        }

        $profile = Profile::find($request->input('id'));

        $profile->name        = $request->input('name');
        $profile->position = $request->input('position');
        $profile->facebook = $request->input('facebook');
        $profile->twitter  = $request->input('twitter');
        $profile->youtube  = $request->input('youtube');
        $profile->dribble  = $request->input('dribble');
        $profile->linkedin  = $request->input('linkedin');
        $profile->phone  = $request->input('phone');
        $profile->email  = $request->input('email');
        $profile->box_no  = $request->input('box_no');
        $profile->post_code  = $request->input('post_code');
        $profile->town  = $request->input('town');
        $profile->address  = $request->input('address');
        $profile->details  = $request->input('details');

        if ($request->hasFile('picture')) {
            $image = Img::make($request->file('picture')->getRealPath());
            // $image->fit(359, 244);
            $img = json_decode($request->input('image_cropdetails'));
            $image->crop((int) $img->width, (int) $img->height, (int) $img->x, (int) $img->y);

            $dir = public_path('images/profiles/');
            if (!file_exists($dir)) {
                mkdir($dir, 0755, TRUE);
            }
            $filename = time() . '.jpg';

            $profile->deletePicture();

            $profile->picture = $filename;
            $image->save($dir . $filename);
        }

        $profile->save();

        $profile->pages()->detach($profile->pageIds());
        $profile->pages()->attach($request->input('pages'));

        return redirect()
            ->route('admin-profiles')
            ->with('global-success', 'Profile added successfuly');
    }

    public function postDelete(Request $request)
    {
        $profile = Profile::find($request->input('id'));
        $profile->deletePicture();
        $profile->pages()->detach($profile->pageIds());
        $profile->delete();

        return response(['message' => 'Profile deleted successfuly'])
            ->header('Content-Type', 'application/json');
    }

    public function postPublish(Request $request)
    {
        $profile = Profile::find($request->input('id'));
        $profile->published = !$profile->published;
        $profile->save();

        return response(['message' => $profile->published ? 'Profile has been published' : 'Profile has been unpublished'])
            ->header('Content-Type', 'application/json');
    }

    public function postFeature(Request $request)
    {
        $profile = Profile::find($request->input('id'));
        $profile->featured = !$profile->featured;
        $profile->save();

        return response(['message' => $profile->featured ? 'Profile has been featured' : 'Profile has been unfeatured'])
            ->header('Content-Type', 'application/json');
    }

    public function getPositions()
    {
        $profiles = Profile::distinct('position')->get(['position'])->pluck('position');

        $positions = $profiles->toArray();

        // foreach ($profiles as $key => $value) {
        // 	$positions[] = $value->position;
        // }

        return response($positions)
            ->header('Content-Type', 'application/json');
    }
}
