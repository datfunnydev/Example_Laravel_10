<?php

namespace App\Repositories;

use App\Models\RolePermission;
use Illuminate\Support\Facades\Auth;

class RolePermissionRepository extends BaseRepository
{
    public function model(): string
    {
        return RolePermission::class;
    }

    public function check(string $route_name): bool
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->type == 0) {
                return true;
            }
            if (str_contains($route_name, 'show')) {
                $route_name = str_replace('show', 'index', $route_name);
            }
            $roles = $user->roles;
            foreach ($roles as $role) {
                $permissions = $role->permissions;
                foreach ($permissions as $permission) {
                    if ($route_name == $permission->name) {
                        return true;
                    }
                }
            }
        }

        return false;
    }
}
