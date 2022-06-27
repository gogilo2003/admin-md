<?php

namespace Ogilo\AdminMd\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Artisan;

use Validator;

class SettingsController extends Controller
{

	function postMigrate(Request $request){
        $validator = Validator::make($request->all(),[
            'key'=>'required',
        ]);

        if($validator->fails()){
            return response('Page Not found',404);
        }
        if($setupkey = config('setup.key')){
            $output = null;
            if(Hash::check($request->key,$setupkey)){
                if (!defined('STDIN')) {
                    define('STDIN',fopen("php://stdin","r"));
                }
                Artisan::call('migrate',[
                    '--step'=>true,
                    '--force'=> true
                ]);
                $output['migration'] = Artisan::output();

                return response()->json($output);
            }else{
                return response('Page Not found',404);
            }
        }else{
            if($request->key){
                $fp = fopen(config_path('setup.php') , 'w');
                fwrite($fp, '<?php return ' . var_export(['key'=>Hash::make($request->key)], true) . ';');
                fclose($fp);
            }
        }
    }

	function postSitemap(Request $request){
        $validator = Validator::make($request->all(),[
            'key'=>'required',
        ]);

        if($validator->fails()){
            return response('Page Not found',404);
        }
        if($setupkey = config('setup.key')){
            $output = null;
            if(Hash::check($request->key,$setupkey)){
                if (!defined('STDIN')) {
                    define('STDIN',fopen("php://stdin","r"));
                }
                Artisan::call('sitemap:generate',[]);
                $output['sitemap'] = Artisan::output();

                return response()->json($output);
            }else{
                return response('Page Not found',404);
            }
        }else{
            if($request->key){
                $fp = fopen(config_path('setup.php') , 'w');
                fwrite($fp, '<?php return ' . var_export(['key'=>Hash::make($request->key)], true) . ';');
                fclose($fp);
            }
        }
    }
}
