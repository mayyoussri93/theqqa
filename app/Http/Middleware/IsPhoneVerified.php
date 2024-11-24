<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class IsPhoneVerified
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

            if (Auth::check() && auth::user()->phone_verified_at == null){
                flash(translate('يجب تاكيد تفعيل رقم جوالك من اعدادات الهاتف'))->error();
                return redirect()->route('verification');
            }
            return $next($request);


    }
}
