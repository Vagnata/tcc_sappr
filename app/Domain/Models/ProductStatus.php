<?php

namespace App\Domain\Models;

use App\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 */
class ProductStatus extends Model
{
    protected $table = 'product_status';

    public function isActive()
    {
        return $this->id == ProductStatusEnum::ACTIVE;
    }
}
