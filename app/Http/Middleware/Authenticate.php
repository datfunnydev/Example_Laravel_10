<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $path = parse_url(url()->full(), PHP_URL_PATH);
            $path = trim($path, '/');
            if ($path !== '') {
                return url('/login?next_url='.$path);
            }

            return url('/login');
        }
    }
}
