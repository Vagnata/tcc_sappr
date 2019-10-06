<?php

namespace App\Domain\Services;

use App\Domain\Repositories\ProductRepository;
use App\Enums\ProductStatusEnum;
use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Fluent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductService
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function findBy(array $filter): Collection
    {
        $filter = removeNullItems($filter);
        $data = new Fluent($filter);

        if (!empty($data->{'buscar'})) {
            return $this->productRepository->findBySearch($data->{'buscar'});
        }


        return $this->productRepository->findAll($filter);
    }

    public function findById(int $id): Product
    {
        $products = $this->productRepository->findBy('id', $id);

        if (!$products->count()) {
            throw new NotFoundHttpException('Produto não encontrado');
        }

        return $products->first();
    }

    public function inactive(Product $product): Product
    {
        $data = ['product_status_id' => ProductStatusEnum::INACTIVE];

        return $this->productRepository->update($product, $data);
    }

    public function create(array $data): Product
    {
        $data      = new Fluent($data);
        $imagePath = null;

        if ($data->{'product_image'}) {
            $imagePath = $data->{'product_image'}->getClientOriginalName();
        }

        $attributes = [
            'unity_type_id'     => $data->{'unity_type_id'},
            'name'              => $data->{'name'},
            'image_path'        => $imagePath,
            'product_status_id' => ProductStatusEnum::ACTIVE
        ];

        return $this->productRepository->create($attributes);
    }

    public function update(Product $product, array $data): Product
    {
        return $this->productRepository->update($product, $data);
    }
}
