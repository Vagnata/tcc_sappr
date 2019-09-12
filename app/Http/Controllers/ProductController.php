<?php

namespace App\Http\Controllers;

use App\Domain\Services\ProductService;
use App\Enums\UnityType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $productService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->productService = new ProductService();
    }

    public function list(Request $request)
    {
        $products = $this->productService->findBy($request->all());

        return view('product.list')->with('products', $products);
    }

    public function showForm(Request $request)
    {
        $unityTypes = UnityType::getToForm();

        if ($request->route('id')) {
            return 'edição';
        } else {
            return view('product.form')->with([
                'unityTypes' => $unityTypes
            ]);
        }
    }

    public function store(Request $request)
    {
        if (!is_null($request->file('product_image'))) {
            $this->productService->saveProductImage($request->file('product_image'));
        }

        $this->productService->create($request->toArray());

        $products = $this->productService->findBy($request->all());

        return view('product.list')->with('products', $products);
    }
}
