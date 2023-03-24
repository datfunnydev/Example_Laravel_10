<?php

namespace App\Repositories;

use App\Models\UserRole;

class UserRoleRepository extends BaseRepository
{
    public function model(): string
    {
        return UserRole::class;
    }
}
