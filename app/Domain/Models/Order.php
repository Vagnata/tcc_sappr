<?php

namespace App\Domain\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed created_at
 * @property mixed updated_at
 * @property mixed quantity
 * @property mixed price
 * @property mixed sale_status_id
 * @property mixed announcement_id
 * @property mixed id
 */
class Order extends Model
{
    protected $table = 'sales';
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'announcement_id',
        'user_id',
        'sale_status_id',
        'quantity',
        'price',
        'discount',
        'created_at',
        'updated_at',
        'address',
        'phone'
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function announcement()
    {
        return $this->belongsTo(Announcement::class, 'announcement_id', 'id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'sale_status_id', 'id');
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2);
    }

    public function getCreatedDateFormatted()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function getUpdatedDateFormatted()
    {
        return $this->updated_at->format('d/m/Y');
    }

    public function isAwaitingConfirmation()
    {
        return $this->sale_status_id == OrderStatusEnum::AWAITING_CONFIRMATION;
    }

    public function isConfirmed()
    {
        return $this->sale_status_id == OrderStatusEnum::CONFIRMED;
    }

    public function isFinalized()
    {
        return $this->sale_status_id == OrderStatusEnum::FINALIZED;
    }

    public function withdrawType(): string
    {
        return $this->local_withdraw ? 'Entrega' : 'Retirada no Local';
    }
}
