<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository extends BaseRepository
{
    public function model(): string
    {
        return User::class;
    }

    public function user_datatable(): Builder
    {
        return $this->query()
            ->with('role')
            ->whereNot('type', '=', 0);
    }

    public function delete_user_datatable(): Builder
    {
        return $this->query()
            ->onlyTrashed()
            ->with('role')
            ->whereNot('type', '=', 0);
    }
}
