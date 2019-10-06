<?php

namespace App\Domain\Models;

use App\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property boolean local_withdraw
 * @property mixed price
 * @property mixed begin_date
 * @property mixed end_date
 */
class Announcement extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'begin_date',
        'end_date'
    ];
    protected $fillable = [
        'product_id',
        'name',
        'local_withdraw',
        'quantity',
        'price',
        'image_path',
        'announcement_status_id',
        'created_at',
        'updated_at',
        'begin_date',
        'end_date',
        'user_id'
    ];
    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function announcementStatus()
    {
        return $this->belongsTo(AnnouncementStatus::class, 'announcement_status_id', 'id');
    }

    public function withdrawType(): string
    {
        return $this->local_withdraw ? 'Entrega' : 'Retirada no Local';
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2);
    }

    public function getBeginDateFormatted()
    {
        return $this->begin_date->format('d/m/Y');
    }

    public function getEndDateFormatted()
    {
        return $this->end_date->format('d/m/Y');
    }
}
