<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AnnouncementStatus extends Model
{
    const ACTIVE   = 1;
    const INACTIVE = 2;
}
