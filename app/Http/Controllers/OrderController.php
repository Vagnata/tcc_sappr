<?php

namespace App\Http\Controllers;

use App\Domain\Services\AnnouncementService;
use App\Domain\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    }
}