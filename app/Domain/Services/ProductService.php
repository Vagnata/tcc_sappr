<?php

namespace App\Domain\Services;

use App\Domain\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Fluent;

class ProductService
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function findBy(array $filter): Collection
    {
        return $this->productRepository->findAll($filter);
    }
}
