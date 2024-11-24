<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Session;
use Config;

class ApiLanguage
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
        if(!empty(request()->segment(2))){
            $locale = request()->segment(2);
        }
        else{
            $locale = 'en';
        }


        App::setLocale($locale);
        return $next($request);
    }
}
