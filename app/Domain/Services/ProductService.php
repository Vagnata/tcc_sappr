<?php

namespace App\Domain\Services;

use App\Domain\Repositories\ProductRepository;
use App\Enums\ProductStatus;
use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
            'product_status_id' => ProductStatus::ACTIVE
        ];

        return $this->productRepository->create($attributes);
    }

    public function saveProductImage(UploadedFile $file): void
    {
        Storage::disk('products')->put($file->getClientOriginalName(), File::get($file));
    }
}
