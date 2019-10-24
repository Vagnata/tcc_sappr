<?php

namespace App\Http\Controllers;

use App\Domain\Services\AnnouncementService;
use App\Domain\Services\ProductService;
use App\Enums\ProductStatusEnum;
use App\Enums\WithdrawTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    private $announcementService;
    private $productService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->announcementService = new AnnouncementService();
        $this->productService      = new ProductService();
    }

    public function list(Request $request)
    {
        if (Auth::check()) {

            $announcements = $this->announcementService->findByUser($request->all());

            return view('announcement.list')->with('announcements', $announcements);
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
}
