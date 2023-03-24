<?php

namespace App\Repositories;

use App\Models\LogActivity;
use Illuminate\Database\Eloquent\Builder;

class LogActivityRepository extends BaseRepository
{
    public function model(): string
    {
        return LogActivity::class;
    }

    public function datatable(): Builder
    {
        return $this->query()->with(['user' => function ($query) {
            $query->withTrashed();
        }]);
    }
}
