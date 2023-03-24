<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository extends BaseRepository
{
    public function model(): string
    {
        return Role::class;
    }

    public function getAll(): Collection
    {
        return $this->query()->orderBy('name')->get();
    }

    public function datatable(): Builder
    {
        return $this->query();
    }
}
