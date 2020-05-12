<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class LoginMiddleware
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
        // nếu user đã đăng nhập
        if (Auth::check()) {
            $user = Auth::user();
            // nếu level =1 (admin), status = 1 (actived) thì cho qua.
            if ($user->is_admin == 1) {
                return $next($request);
            } else {
                return redirect('/');
            }
        } else
            return redirect('/login');
    }
}
