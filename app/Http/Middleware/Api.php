<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Api
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
//        $token = $request->input('access_token', $request->bearerToken());

//        if ($token) {
//            list() = explode("\t", decrypt($token));
            return $next($request);
//        }

//        return response(json_encode(['message' => 'need token', 'code' => 401]), 401);
    }
}
