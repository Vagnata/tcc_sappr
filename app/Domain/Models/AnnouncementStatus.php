<?php

namespace App\Domain\Models;

use App\Enums\AnnouncementStatusEnum;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 */
class AnnouncementStatus extends Model
{
    const ACTIVE   = 1;
    const INACTIVE = 2;

    protected $table = 'announcement_status';

    public function isActive()
    {
        return $this->id == AnnouncementStatusEnum::ACTIVE;
    }
}
