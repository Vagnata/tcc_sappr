<?php

namespace App\Domain\Models;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'begin_date',
        'end_date'
    ];
    protected $fillable = [
        'product_id',
        'name',
        'local_withdraw',
        'quantity',
        'price',
        'image_path',
        'announcement_status_id',
        'created_at',
        'updated_at',
        'begin_date',
        'end_date',
        'user_id'
    ];
    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
