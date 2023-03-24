<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Models\PermissionCategory;
use Illuminate\Database\Eloquent\Collection;

class PermissionRepository extends BaseRepository
{
    public function model(): string
    {
        return Permission::class;
    }

    public function getByCategory(): Collection
    {
        return PermissionCategory::query()
            ->with('permission')
            ->orderBy('name')
            ->get();
    }
}
