<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
class IsAdmin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ( Auth::check() )
        {        	
        	if(Auth::user()->status == 2){
        		return "Tài khoản đã bị khóa.";die;
        	}
            return $next($request);
        }
		return redirect()->route('backend.login-form');
	}

}
