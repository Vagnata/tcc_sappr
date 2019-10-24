<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'sale_status';

    protected $fillable = [
      'name'
    ];
}
