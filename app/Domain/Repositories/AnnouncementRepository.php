<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Announcement;

use Carbon\Carbon;
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
        $this->appendDateIntervalFilter($builder);
        $this->appendIdFilter($builder, $data->{'id'});

        return $builder->get();
    }

    private function appendSearchFilter(Builder $builder, $search): Builder
    {
        if (!empty($search)) {
            $builder->where('announcements.name', 'like', "%$search%");
        }

        return $builder;
    }

    private function appendDateIntervalFilter(Builder $builder): Builder
    {
        $now = Carbon::today()->setTimezone('America/Sao_paulo')->toDateTimeString();

        return $builder->whereRaw("'$now' between begin_date AND end_date");
    }

    private function appendIdFilter(Builder $builder, $id): Builder
    {
        if (!is_null($id)) {
            $builder->where('id', $id);
        }

        return $builder;
    }
}
