<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Order;

class OrderRepository extends RepositoryAbstract
{
    protected $model = Order::class;
}
