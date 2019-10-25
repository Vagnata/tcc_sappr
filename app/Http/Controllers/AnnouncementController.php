<?php

namespace App\Http\Controllers;

use App\Domain\Services\AnnouncementService;
use App\Domain\Services\OrderService;
use App\Domain\Services\ProductService;
use App\Enums\ProductStatusEnum;
use App\Enums\WithdrawTypeEnum;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AnnouncementController extends Controller
{
    private $announcementService;
    private $productService;
    private $orderService;

    public function __construct()
    {
        $this->announcementService = new AnnouncementService();
        $this->productService      = new ProductService();
        $this->orderService        = new OrderService();
    }

    public function list(Request $request)
    {
        if (Auth::check()) {
            $withdrawTypes = WithdrawTypeEnum::getToForm();
            $announcements = $this->announcementService->findByUser($request->all());

            return view('announcement.list')->with([
                'announcements' => $announcements,
                'withdrawTypes' => $withdrawTypes,
                'filter'        => $request->all()
            ]);
        }

        return view('user.login')->with('message', trans('message.login.unauthorized'));
    }

    public function showForm(Request $request)
    {
        if (Auth::check()) {

            $return = [
                'products'      => $this->productService->findBy(['product_status_id' => ProductStatusEnum::ACTIVE]),
                'withdrawTypes' => WithdrawTypeEnum::getToForm()
            ];

            if ($request->route('id')) {
                return 'edição';
            }

            return view('announcement.form', $return);
        }

        return view('user.login')->with('message', trans('message.login.unauthorized'));
    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            $fileName = $this->announcementService->saveProductImage($request->file('product_image'));

            if ($request->has('id')) {
                $product = $this->productService->findById((int)$request->get('id'));
                $this->productService->update($product, $request->all());
            } else {
                $this->announcementService->create($request->all(), $fileName);
            }

            $announcements = $this->announcementService->findByUser($request->all());

            return view('announcement.list')->with('announcements', $announcements);
        }

        return view('user.login')->with('message', trans('message.login.unauthorized'));
    }

    public function delete($id)
    {
        try {
            $announcement = $this->announcementService->findByKey('id', $id)->first();
            $orders       = $this->orderService->findByAnnouncement($announcement);

            if ($orders->count()) {
                $this->response = [
                    'data' => false,
                    'message' => 'Não é possível inativar este anúncio. Existem pedidos aguardando confirmação'
                ];

            } else {
                $announcement = $this->announcementService->inactive($announcement);

                $this->response = [
                    'id' => $announcement->id
                ];
            }


        } catch (NotFoundHttpException $exception) {
            return Response::json(['data' => 'Anúncio não encontrado ou inativo'], HttpResponse::HTTP_NOT_FOUND);
        }

        return Response::json($this->response, HttpResponse::HTTP_OK);
    }
}
