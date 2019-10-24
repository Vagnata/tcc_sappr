<?php

namespace App\Http\Controllers;

use App\Domain\Services\AnnouncementService;
use App\Domain\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class OrderController extends Controller
{
    private $announcementService;
    private $orderService;

    public function __construct()
    {
        $this->announcementService = new AnnouncementService();
        $this->orderService        = new OrderService();
    }

    public function checkoutPage(Request $request)
    {
        if (Auth::check()) {
            $announcement = $this->announcementService->findBy(['id' => $request->route('id')])->first();

            return view('order.checkout')->with('announcement', $announcement);
        }

        return view('user.login')->with('message', trans('message.order.unauthorized'));
    }

    public function storeOrder(Request $request)
    {
        $announcement = $this->announcementService->findBy(['id' => $request->get('id')])->first();

        $order = $this->orderService->create($announcement, $request->all());
        $this->announcementService->editCurrentQuantity($announcement, $order);

        $orders = $this->orderService->findMyOrders();

        return view('order.my_orders_list')->with(['orders' => $orders, 'newOrder' => $order]);
    }

    public function myOrders(Request $request)
    {
        $orders = $this->orderService->findMyOrders();

        return view('order.my_orders_list')->with('orders', $orders);
    }

    public function cancelOrder($id)
    {
        try {
            $order        = $this->orderService->findByFilter(['id' => $id])->first();
            $announcement = $this->announcementService->findByKey('id', $order->announcement_id)->first();

            $order = $this->orderService->cancel($order);
            $this->announcementService->updateBalance($announcement, $order);

            $this->response = [
                'id' => $order->id
            ];
        } catch (NotFoundHttpException $exception) {
            return Response::json(['data' => 'Pedido não encontrado ou inativo'], HttpResponse::HTTP_NOT_FOUND);
        }

        return Response::json($this->response, HttpResponse::HTTP_OK);
    }
}
