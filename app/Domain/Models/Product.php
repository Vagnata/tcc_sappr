<?php

namespace App;

use App\Domain\Models\ProductStatus;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'unity_type_id',
        'name',
        'image_path',
        'product_status_id'
    ];

    public function unityType()
    {
        return $this->belongsTo(UnityType::class, 'unity_type_id', 'id');
    }

    public function productStatus()
    {
        return $this->belongsTo(ProductStatus::class, 'product_status_id', 'id');
    }
}
