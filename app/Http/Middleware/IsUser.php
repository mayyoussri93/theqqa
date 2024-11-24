<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class IsUser
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
        if (Auth::check() &&
            (Auth::user()->user_type == 'customer' ||
                Auth::user()->user_type == 'seller' ||
                Auth::user()->user_type == 'delivery_boy') ) {

            return $next($request);
        }
        else{

            if(!empty(Session::get('cv_id'))) {
                return redirect()->route('user.registration');

            }
            session(['link' => url()->current()]);
            return redirect()->route('user.login');
        }
    }
}
