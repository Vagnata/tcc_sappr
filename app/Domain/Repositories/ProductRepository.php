<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Product;

class ProductRepository extends RepositoryAbstract
{
	protected $model = Product::class;
//
//	public function findBy(array $filter)
//	{
//		return $this->createModel()
//            ->where('announcement_status_id', AnnouncementStatus::ACTIVE)
//            ->get();
//	}
}
