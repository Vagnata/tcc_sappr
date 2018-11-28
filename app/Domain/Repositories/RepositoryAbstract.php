<?php

namespace Sun\Domain\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use App\Domain\Repositories\RepositoryInterface;

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
        $instance = (new $this->model());
        if (Session::has('database') && empty($instance->getConnectionName())) {
            $instance->setConnection(Session::get('database'));
        }
        return $instance;
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

    public function getBuilder(): Builder
    {
        return $this->createModel()->where([]);
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
