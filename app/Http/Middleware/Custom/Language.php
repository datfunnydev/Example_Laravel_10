<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Language
{
    public function handle($request, Closure $next)
    {
        if (session()->has('language')) {
            App::setlocale(Session::get('language'));
        }

        return $next($request);
    }
}
