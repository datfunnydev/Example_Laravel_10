<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\PermissionCategory;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class PermissionCommand extends Command
{
    protected $signature = 'permission:get';

    public function handle()
    {
        $routeCollection = Route::getRoutes();
        $array = ['sanctum', 'debugbar', 'ignition', 'generated', '.show'];
        foreach ($routeCollection as $value) {
            $kt = true;
            foreach ($array as $key) {
                if (str_contains($value->getName(), $key)) {
                    $kt = false;
                }
            }
            if ($value->getName() && $kt) {
                try {
                    $route_name = $value->getName();
                    $query_permission = Permission::query()->where('name', $route_name)->exists();
                    if (! $query_permission) {
                        $category_name = explode('.', $route_name)[0];
                        $permission_name = explode('.', $route_name)[1];
                        $query_category = PermissionCategory::query()->where('name', $category_name)->first();
                        if (! $query_category) {
                            $query_category = PermissionCategory::query()->create(['name' => $category_name]);
                        }
                        Permission::query()->create([
                            'category_id' => $query_category['id'],
                            'name' => $route_name,
                            'title' => __($permission_name),
                        ]);
                    }
                } catch (Exception $e) {
                    print_r($e);
                }
            }
        }
    }
}
