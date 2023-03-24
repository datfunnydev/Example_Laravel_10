<?php

namespace App\Providers;

use App\Repositories\RolePermissionRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    private RolePermissionRepository $role_permission;

    public function register()
    {
        $this->role_permission = new RolePermissionRepository();
    }

    public function boot()
    {
        Blade::if('role', function ($route_name) {
            if (Auth::check()) {
                if ($this->role_permission->check($route_name)) {
                    return true;
                }

                return false;
            }

            return false;
        });

        Blade::if('array', function ($route_name) {
            if (Auth::check()) {
                $array = explode(',', $route_name);
                foreach ($array as $key) {
                    if ($this->role_permission->check($key)) {
                        return true;
                    }
                }

                return false;
            }

            return false;
        });
    }
}
