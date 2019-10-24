<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Fluent;

class OrderRepository extends RepositoryAbstract
{
    protected $model = Order::class;

    public function findByFilter(array $filter): Collection
    {
        return $this->createModel()->where($filter)->get();
    }

    public function findByUser($userId, array $filter): Collection
    {
        $filter        = new Fluent($filter);
        $createdAt     = $filter->get('created_at', '');
        $orderStatusId = $filter->get('sale_status_id');

        $builder = $this->createModel()->where('user_id', $userId)->orderBy('created_at', 'DESC');
        $this->appendCreatedAtFilter($builder, $createdAt);
        $this->appendOrderStatusFilter($builder, $orderStatusId);

        return $builder->get();
    }

    private function appendCreatedAtFilter(Builder $builder, $date): Builder
    {
        if (!empty($date)) {
            $date = Carbon::createFromFormat('Y-m-d', $date);

            return $builder->whereBetween('created_at',
                [$date->startOfDay()->toDateTimeString(), $date->endOfDay()->toDateTimeString()]);
        }

        $initialDate = Carbon::create()->subDays(15)->startOfDay()->toDateTimeString();
        $finalDate   = Carbon::create()->endOfDay()->toDateTimeString();

        return $builder->whereBetween('created_at', [$initialDate, $finalDate]);
    }

    private function appendOrderStatusFilter(Builder $builder, $statusId): Builder
    {
        if (!empty($statusId)) {
            $builder->where('sale_status_id', $statusId);
        }

        return $builder;
    }
}
