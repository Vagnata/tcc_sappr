<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    const ADMINISTRATOR = 1;
    const CLIENT        = 2;
}
