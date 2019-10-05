<?php

namespace App\Domain\Repositories;

use App\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends RepositoryAbstract
{
	protected $model = Product::class;

	public function findBySearch(string $search): Collection
    {
	    return $this->createModel()
            ->where('name', 'like', "%$search%")
            ->get();
    }
}
