<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UnityTypeEnum extends Enum
{
    const UNITY    = 1;
    const KILOGRAM = 2;
    const GRAM     = 3;

    public static function getToForm()
    {
        return [
            [
                'id'   => UnityTypeEnum::UNITY,
                'name' => 'Unidade'
            ],
            [
                'id'   => UnityTypeEnum::KILOGRAM,
                'name' => 'Kg'
            ],
            [
                'id'   => UnityTypeEnum::GRAM,
                'name' => 'g'
            ]
        ];
    }
}
