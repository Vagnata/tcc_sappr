<?php

namespace App\Domain\Services;

use App\Domain\Models\AnnouncementStatus;
use App\Domain\Repositories\AnnouncementRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Fluent;

class AnnouncementService
{
    private $announcementRepository;

    public function __construct()
    {
        $this->announcementRepository = new AnnouncementRepository();
    }

    public function findBy(array $filter): Collection
    {
        $filter['announcement_status_id'] = AnnouncementStatus::ACTIVE;

        return $this->announcementRepository->findAll($filter);
    }

    public function findByUser(array $filter): Collection
    {
        $data = new Fluent($filter);

        $filter['created_at'] = $data->{'created_at'};
        $filter['user_id']    = Auth::user()['id'];

        return $this->announcementRepository->findAll(removeNullItems($filter));
    }
}
