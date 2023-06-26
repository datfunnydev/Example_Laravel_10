<?php

namespace App\Repositories;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->makeModel();
    }

    abstract public function model();

    /**
     * @throws BindingResolutionException
     * @throws Exception
     */
    public function makeModel(): Model
    {
        $model = app()->make($this->model());

        if (! $model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    public function query(): Model|Builder|Collection
    {
        return $this->model->query();
    }

    public function find(string|int $id, array $columns = ['*']): Model|Builder|null
    {
        return $this->query()->findOrFail($id, $columns);
    }

    public function findKeyNot(string|int $id, string $column, string $value): Model|Builder|null
    {
        return $this->query()->whereKeyNot($id)->where($column, '=', $value)->first();
    }

    public function findMany(array $ids, array $columns = ['*']): Collection|null
    {
        return $this->query()->findMany($ids, $columns);
    }

    public function findColumn(string $column, string $value, array $columns = ['*']): Model|Builder|null
    {
        return $this->query()->where($column, '=', $value)->first($columns);
    }

    public function exitsColumn(string $column, string $value): bool
    {
        return $this->query()->where($column, '=', $value)->exists();
    }

    public function exitsKeyNot(string|int $id, string $column, string $value): bool
    {
        return $this->query()->whereKeyNot($id)->where($column, '=', $value)->exists();
    }

    public function getColumn(string $column, string $value, array $columns = ['*']): Collection|null
    {
        return $this->query()->where($column, '=', $value)->pluck($columns);
    }

    public function create(array $data): Model|bool
    {
        try {
            return $this->query()->create($data);
        } catch (Exception) {
            return false;
        }
    }

    public function createMultiple(array $data): bool|int
    {
        try {
            return $this->query()->insertOrIgnore($data);
        } catch (Exception) {
            return false;
        }
    }

    public function update(string|int $id, array $data): bool
    {
        $query = $this->find($id);
        if ($query) {
            $query->update($data);

            return true;
        }

        return false;
    }

    public function delete(string|int $id): bool
    {
        try {
            $query = $this->find($id);
            $query?->delete();

            return true;
        } catch (Exception) {
        }

        return false;
    }

    public function deleteAll(string $column, string $value): mixed
    {
        return $this->query()->where($column, '=', $value)->delete();
    }

    public function deleteMultiple(array $ids): bool
    {
        if (count($ids) === 0) {
            return false;
        }
        $this->query()->whereIn('id', $ids)->delete();

        return true;
    }
}
