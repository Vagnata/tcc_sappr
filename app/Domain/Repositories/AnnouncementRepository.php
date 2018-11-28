<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Announcement;
use App\Domain\Models\AnnouncementStatus;

class AnnouncementRepository extends RepositoryAbstract
{
	protected $model = Announcement::class;
	
	public function findBy(array $filter)
	{
		return $this->createModel()
            ->where('announcement_status_id', AnnouncementStatus::ACTIVE)
            ->get();
	}
}