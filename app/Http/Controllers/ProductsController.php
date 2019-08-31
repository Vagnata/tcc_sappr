<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
	private $productService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->productService = new ProductService();
    }
	
    public function list(Request $request)
    {
        $announcements = $this->productService->findBy($request->all());

        return view('announcement.list')->with('announcements', $announcements);
    }
}
