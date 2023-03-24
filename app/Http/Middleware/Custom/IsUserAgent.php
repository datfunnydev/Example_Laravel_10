<?php

namespace App\Http\Middleware\Custom;

use Closure;

class IsUserAgent
{
    public function handle($request, Closure $next)
    {
        if ($_SERVER['HTTP_USER_AGENT'] !== '...') {
            abort(403);
        }

        return $next($request);
    }
}
