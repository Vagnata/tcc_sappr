<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Announcement;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Fluent;

class AnnouncementRepository extends RepositoryAbstract
{
	protected $model = Announcement::class;

    public function findByFilter(array $filter): Collection
    {
        $data = new Fluent($filter);

        $builder = $this->createModel()
            ->where('announcement_status_id', $data->{'announcement_status_id'});

        $this->appendSearchFilter($builder, $data->{'buscar'});

        return $builder->get();
    }

    private function appendSearchFilter(Builder $builder, $search): Builder
    {
        if (!empty($search)) {
            $builder->where('announcements.name', 'like', "%$search%");
        }

        return $builder;
    }
}
