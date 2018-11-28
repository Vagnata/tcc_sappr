<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function unityType()
    {
        return $this->belongsTo(UnityType::class, 'unity_type_id', 'id');
    }
}
