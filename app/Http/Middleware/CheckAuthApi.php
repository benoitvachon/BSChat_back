<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CheckAuthApi
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
        $access_token = $request->header('Authorization');

        $user = User::where([['remember_token', '=', $access_token],
                                    ['remember_token', '<>', '']])->count();

        if($user == 1) {
            return $next($request);
        }
    }
}
