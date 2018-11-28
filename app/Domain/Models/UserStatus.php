<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    const ACTIVE   = 1;
    const INACTIVE = 2;
}
