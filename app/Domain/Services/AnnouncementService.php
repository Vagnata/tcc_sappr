<?php

namespace App\Domain\Services;

use App\Domain\Models\Announcement;
use App\Domain\Models\AnnouncementStatus;
use App\Domain\Repositories\AnnouncementRepository;
use App\Enums\AnnoucementStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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

        $attributes['created_at'] = $data->{'created_at'};
        $attributes['user_id']    = Auth::user()['id'];

        return $this->announcementRepository->findAll(removeNullItems($attributes));
    }

    public function create(array $data, string $fileName): Announcement
    {
        $data = new Fluent($data);

        $attributes = [
            'product_id'             => $data->{'product_id'},
            'name'                   => $data->{'name'},
            'local_withdraw'         => $data->{'local_withdraw'},
            'quantity'               => $data->{'quantity'},
            'price'                  => $data->{'price'},
            'begin_date'             => $data->{'begin_date'},
            'end_date'               => $data->{'end_date'},
            'image_path'             => $fileName,
            'user_id'                => Auth::user()['id'],
            'announcement_status_id' => AnnoucementStatusEnum::ACTIVE
        ];

        return $this->announcementRepository->create($attributes);
    }

    public function saveProductImage(UploadedFile $file): string
    {
        $fileName = Carbon::create()->timestamp . $file->getClientOriginalExtension();
        Storage::disk('products')->put($fileName, File::get($file));

        return $fileName;
    }
}
