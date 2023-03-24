<?php

namespace App\Http\Middleware\Custom;

use App\Repositories\RolePermissionRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AccessPermission
{
    private RolePermissionRepository $permission;

    public function __construct(RolePermissionRepository $permission)
    {
        $this->permission = $permission;
    }

    public function handle(Request $request, Closure $next)
    {
        $route_name = Route::currentRouteName();
        if (! $route_name || $this->permission->check($route_name)) {
            return $next($request);
        }
        abort(403);
    }
}
