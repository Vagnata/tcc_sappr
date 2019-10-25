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

            return $builder->whereBetween('sales.created_at',
                [$date->startOfDay()->toDateTimeString(), $date->endOfDay()->toDateTimeString()]);
        }

        $initialDate = Carbon::create()->subDays(15)->startOfDay()->toDateTimeString();
        $finalDate   = Carbon::create()->endOfDay()->toDateTimeString();

        return $builder->whereBetween('sales.created_at', [$initialDate, $finalDate]);
    }

    private function appendOrderStatusFilter(Builder $builder, $statusId): Builder
    {
        if (!empty($statusId)) {
            $builder->where('sales.sale_status_id', $statusId);
        }

        return $builder;
    }

    public function findReceivedOrders(array $filter): Collection
    {
        $filter = new Fluent($filter);

        $builder = $this->createModel()
            ->select([
                'sales.id',
                'users.name as clientName',
                'sales.phone',
                'sales.address',
                'products.name as productName',
                'sales.quantity',
                'sales.price',
                'announcements.local_withdraw',
                'sales.created_at',
                'sale_status.id as orderStatusId',
                'sale_status.name as orderStatusName',
            ])
            ->where('owner.id', $filter->{'user_id'})
            ->join('sale_status', 'sale_status.id', '=', 'sales.sale_status_id')
            ->join('announcements', 'announcements.id', '=', 'sales.announcement_id')
            ->join('announcement_status', 'announcement_status.id', '=', 'announcements.announcement_status_id')
            ->join('products', 'products.id', '=', 'announcements.product_id')
            ->join('users', 'users.id', '=', 'sales.user_id')
            ->join('users as owner', 'owner.id', '=', 'announcements.user_id')
            ->orderBy('sales.created_at', 'DESC');

        $builder = $this->appendCreatedAtFilter($builder, $filter->get('created_at', ''));
        $builder = $this->appendOrderStatusFilter($builder, $filter->get('sale_status_id', ''));

        return $builder->get();
    }
}
