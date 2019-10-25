<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatusEnum extends Enum
{
    const AWAITING_CONFIRMATION = 1;
    const CONFIRMED             = 2;
    const CANCELLED             = 3;
    const FINALIZED             = 4;

    public static function toForm()
    {
        return [
            [
                'id' => self::AWAITING_CONFIRMATION,
                'name' => 'Aguardando Confirmação'
            ],
            [
                'id' => self::CONFIRMED,
                'name' => 'Confirmado'
            ],
            [
                'id' => self::CANCELLED,
                'name' => 'Cancelado'
            ]
        ];
    }
}
