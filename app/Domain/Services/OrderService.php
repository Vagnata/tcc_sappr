<?php

namespace App\Domain\Services;

use App\Domain\Repositories\OrderRepository;

class OrderService
{
    private $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }
}
