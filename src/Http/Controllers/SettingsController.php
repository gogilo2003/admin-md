<?php
namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Ogilo\AdminMd\Models\ArticleCategory;

use Validator;

/**
*
*/
class SettingsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

    public function getSettings()
    {
        $admin = null;
        if (config('admin')) {
            $admin = config('admin');
        } else {
            \save_admin_config();
            $admin = config('admin');
        }

        // dd($admin);

        return view('admin::settings',$admin);
    }

    public function postSettings(Request $request)
    {
        // $menu = config('admin.menu');
        // $admin = array(
        //     'articles' => $request->has_articles ? true : false,
        //     'pictures' => $request->has_pictures ? true : false,
        //     'videos' => $request->has_videos ? true : false,
        //     'files' => $request->has_files ? true : false,
        //     'projects' => $request->has_projects ? true : false,
        //     'profiles' => $request->has_profiles ? true : false,
        //     'sermons' => $request->has_sermons ? true : false,
        //     'events' => $request->has_events ? true : false,
        //     'packages' => $request->has_packages ? true : false,
        //     'products' => $request->has_products ? true : false,
        //     'contact' => $request->email,
        //     'content_css' => $request->content_css,
        //     'menu' => $menu,
        // );

        $admin = config('admin');
        // dump($admin);

        config(['admin.articles'=>$request->has_articles ? true : false]);
        config(['pictures' => $request->has_pictures ? true : false]);
        config(['videos' => $request->has_videos ? true : false]);
        config(['files' => $request->has_files ? true : false]);
        config(['projects' => $request->has_projects ? true : false]);
        config(['profiles' => $request->has_profiles ? true : false]);
        config(['sermons' => $request->has_sermons ? true : false]);
        config(['events' => $request->has_events ? true : false]);
        config(['packages' => $request->has_packages ? true : false]);
        config(['products' => $request->has_products ? true : false]);
        config(['contact' => $request->email]);
        config(['content_css' => $request->content_css]);

        $admin = config('admin');
        // dd($admin);


        \save_admin_config($admin);

        return redirect()
                ->route('admin-settings')
                ->with('global-success','Settings saved');
    }

    function migrate($key){
        if($setupkey = config('setup.key')){
            $output = null;
            if(Hash::check($key,$setupkey)){
                // Artisan::call('vendor:publish',[
                //     '--force'=>true,
                //     '--tag'=>'admin-migrations'
                // ]);
                // $output = Artisan::output();

                Artisan::call('migrate',[
                    '--step'=>true
                ]);
                $output .= "\n\n". Artisan::output();

                return '<pre>'.$output.'</pre>';
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
    }

}
