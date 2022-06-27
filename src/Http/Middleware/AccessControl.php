<?php

namespace Ogilo\AdminMd\Http\Middleware;

use Closure;
use Auth;

use Ogilo\AdminMd\Models\AdminRole;

class AccessControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd($this->authorize($request));

        if (str_starts_with($request->path(),'admin')){
            if(!$this->authorize($request)){
                return redirect()
                        ->back()
                        ->with('global-danger',"You are not aothorised to access this resource");
            }

        }

        return $next($request);
    }

    private function authorize($request){
        $user = $request->user();

        if($user){
            $roles = explode(',',$user->role->details);
            $name = $request->route()->getName();
            // return $name;
            $f = array_search($name,$roles);
            // return $f;
            if($f===false){
                return false;
            }else{
                return true;
            }
        }
        return true;
    }

}
