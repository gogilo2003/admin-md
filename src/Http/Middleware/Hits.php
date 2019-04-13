<?php

namespace Ogilo\Admin\Http\Middleware;

use Closure;

use Ogilo\Admin\Models\Hit;

class Hits
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

        // dd($request);

        $hit = new Hit;

        $hit->ip = $request->ip();
        $hit->url = $request->fullUrl();
        $hit->method = $request->method();
        $hit->user_agent = $request->server('HTTP_USER_AGENT');
        $hit->browser = getBrowser($request->server('HTTP_USER_AGENT'));
        $hit->platform = getOs($request->server('HTTP_USER_AGENT'));
        $hit->language = $request->server('HTTP_ACCEPT_LANGUAGE') ? $request->server('HTTP_ACCEPT_LANGUAGE') : 'Unknown';
        $hit->wants_json = $request->wantsJson();
        $hit->is_json = $request->isJson();
        $hit->ajax = $request->ajax();
        $hit->pjax = $request->pjax();

        $hit->save();

        return $next($request);
    }

}
