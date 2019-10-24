<?php

namespace App\Domain\Services;

use App\Domain\Models\Announcement;
use App\Domain\Models\Order;
use App\Domain\Repositories\OrderRepository;
use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Fluent;

class OrderService
{
    private $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    public function findMyOrders(): Collection
    {
        return $this->orderRepository->findBy('user_id', Auth::id());
    }

    public function create(Announcement $announcement, array $data): Order
    {
        $data     = new Fluent($data);
        $quantity = $data->get('quantity', 0);

        $attributes = [
            'announcement_id' => $announcement->id,
            'user_id'         => Auth::id(),
            'sale_status_id'  => OrderStatusEnum::AWAITING_CONFIRMATION,
            'quantity'        => $quantity,
            'price'           => $announcement->price * $quantity,
            'phone'           => $data->{'phone'},
            'address'         => $data->{'address'}
        ];

        return $this->orderRepository->create($attributes);
    }

}
