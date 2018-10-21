<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    const ADMINISTRATOR = 1;
    const CLIENT        = 2;
}
