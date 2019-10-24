<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository extends RepositoryAbstract
{
    protected $model = Order::class;

    public function findByFilter(array $filter): Collection
    {
        return $this->createModel()
            ->where($filter)
            ->get();
    }

    public function findByUser($userId): Collection
    {
           return $this->createModel()
               ->where('user_id', $userId)
               ->orderBy('created_at', 'DESC')
               ->get();
    }

}
