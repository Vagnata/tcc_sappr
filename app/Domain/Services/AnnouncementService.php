<?php

namespace App\Domain\Services;

use App\Domain\Models\Announcement;
use App\Domain\Models\AnnouncementStatus;
use App\Domain\Models\Order;
use App\Domain\Repositories\AnnouncementRepository;
use App\Enums\AnnouncementStatusEnum;
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

    public function findByKey(string $key, $value): Collection
    {
        return $this->announcementRepository->findBy($key, $value);
    }

    public function findBy(array $filter): Collection
    {
        $filter['announcement_status_id'] = AnnouncementStatus::ACTIVE;

        return $this->announcementRepository->findByFilter(removeNullItems($filter));
    }

    public function findByUser(array $filter): Collection
    {
        $data = new Fluent($filter);

        $attributes['local_withdraw'] = $data->{'tipo_retirada'};
        $attributes['created_at']     = $data->{'created_at'};
        $attributes['user_id']        = Auth::user()['id'];

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
            'current_quantity'       => $data->{'quantity'},
            'price'                  => $data->{'price'},
            'begin_date'             => Carbon::createFromFormat('Y-m-d', $data->{'begin_date'})->startOfDay()->toDateTimeString(),
            'end_date'               => Carbon::createFromFormat('Y-m-d', $data->{'end_date'})->endOfDay()->toDateTimeString(),
            'image_path'             => $fileName,
            'user_id'                => Auth::user()['id'],
            'announcement_status_id' => AnnouncementStatusEnum::ACTIVE,
            'address'                => $data->{'address'},
            'phone'                  => $data->{'phone'}
        ];

        return $this->announcementRepository->create($attributes);
    }

    public function saveProductImage(UploadedFile $file): string
    {
        $fileName = sprintf('%s.%s', Carbon::create()->timestamp, $file->getClientOriginalExtension());
        Storage::disk('products')->put($fileName, File::get($file));

        return $fileName;
    }

    public function editCurrentQuantity(Announcement $announcement, Order $order): Announcement
    {
        $attributes = [
            'current_quantity' => $announcement->current_quantity - $order->quantity
        ];

        return $this->announcementRepository->update($announcement, $attributes);
    }

    public function updateBalance(Announcement $announcement, Order $order)
    {
        $attributes = [
            'current_quantity' => $announcement->current_quantity + $order->quantity
        ];

        return $this->announcementRepository->update($announcement, $attributes);
    }

    public function inactive(Announcement $announcement): Announcement
    {
        $attributes = [
            'announcement_status_id' => AnnouncementStatusEnum::INACTIVE
        ];

        return $this->announcementRepository->update($announcement, $attributes);
    }
}
