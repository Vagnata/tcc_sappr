<?php

namespace App\Http\Controllers;

use App\Domain\Services\AnnouncementService;
use App\Domain\Services\ProductService;
use App\Enums\ProductStatusEnum;
use App\Enums\WithdrawTypeEnum;
use Illuminate\Http\Request;

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
        $announcements = $this->announcementService->findByUser($request->all());

        return view('announcement.list')->with('announcements', $announcements);
    }

    public function showForm(Request $request)
    {
        $return = [
            'products'      => $this->productService->findBy(['product_status_id' => ProductStatusEnum::ACTIVE]),
            'withdrawTypes' => WithdrawTypeEnum::getToForm()
        ];

        if ($request->route('id')) {
            return 'edição';
        }

        return view('announcement.form', $return);
    }

    public function store(Request $request)
    {
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
}
