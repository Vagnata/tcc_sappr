<?php

namespace App\Domain\Services;

use App\Domain\Models\Announcement;
use App\Domain\Models\Order;
use App\Domain\Repositories\OrderRepository;
use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Fluent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderService
{
    private $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    public function findMyOrders(array $filter = []): Collection
    {
        return $this->orderRepository->findByUser(Auth::id(), $filter);
    }

    public function findByFilter(array $filter): Collection
    {
        $filter['sale_status_id'] = OrderStatusEnum::AWAITING_CONFIRMATION;

        $pedidos = $this->orderRepository->findByFilter($filter);

        if (!$pedidos->count()) {
            throw new NotFoundHttpException('Seu pedido já está cancelado ou já foi confirmado. Entre em contato com o fornecedor');
        }

        return $pedidos;
    }

    public function findByAnnouncement(Announcement $announcement): Collection
    {
        $filter = [
            'announcement_id' => $announcement->id,
            'sale_status_id'  => OrderStatusEnum::AWAITING_CONFIRMATION
        ];

        return $this->orderRepository->findByFilter($filter);
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

    public function cancel(Order $order): Order
    {
        $attributes = [
            'sale_status_id' => OrderStatusEnum::CANCELLED
        ];

        return $this->orderRepository->update($order, $attributes);
    }

    public function confirm(Order $order): Order
    {
        $attributes = [
            'sale_status_id' => OrderStatusEnum::CONFIRMED
        ];

        return $this->orderRepository->update($order, $attributes);
    }

    public function findMyReceivedOrders(array $filter): Collection
    {
        $filter = new Fluent($filter);

        $attributes = [
            'user_id'        => Auth::id(),
            'sale_status_id' => $filter->{'sale_status_id'},
            'created_at'     => $filter->{'created_at'}
        ];

        return $this->orderRepository->findReceivedOrders(removeNullItems($attributes));
    }
}
