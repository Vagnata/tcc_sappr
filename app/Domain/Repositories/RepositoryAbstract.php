<?php

namespace App\Domain\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class RepositoryAbstract implements RepositoryInterface
{
    protected $model;

    public function all($attributes = ['*']): Collection
    {
        $instance = $this->createModel();

        return $instance->get($attributes);
    }

    public function create(array $attributes = []): Model
    {
        $instance = $this->createModel();
        $instance->fill($attributes);
        $instance->save();

        return $instance;
    }

    public function createModel(): Model
    {
        return (new $this->model());
    }

    public function findOneBy($key, $value): ?Model
    {
        return $this->createModel()->where($key, '=', $value)->first();
    }

    public function findBy($key, $values): Collection
    {
        if (is_array($values)) {
            return $this->createModel()->whereIn($key, $values)->get();
        }

        return $this->createModel()->where($key, '=', $values)->get();
    }

    public function findAll(array $filter): Collection
    {
        return $this->createModel()->where($filter)->get();
    }

    public function update(Model $instance, array $attributes = []): Model
    {
        $instance->fill($attributes);
        $instance->save();

        return $instance;
    }

    public function delete(Model $instance): bool
    {
        return $instance->delete();
    }
}
