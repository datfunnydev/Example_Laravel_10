<?php

namespace App\Http\Middleware\Custom;

use Illuminate\Support\Facades\Storage;

class Setup
{
    public function handle($request, $next): mixed
    {
        $installed = Storage::disk('public')->exists('installed');
        if (! $installed && ! str_contains($request->url(), 'setup')) {
            return redirect('/setup/step-1');
        }
        if ($installed && str_contains($request->url(), 'setup')) {
            return redirect('/');
        }

        return $next($request);
    }
}
