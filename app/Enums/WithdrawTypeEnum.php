<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class WithdrawTypeEnum extends Enum
{
    const LOCAL    = 0;
    const DELIVERY = 1;

    public static function getToForm()
    {
        return [
            [
                'id'   => self::LOCAL,
                'name' => 'Retirada no local'
            ],
            [
                'id'   => self::DELIVERY,
                'name' => 'Entrega'
            ]
        ];
    }
}
