<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UnityType extends Enum
{
    const UNITY    = 1;
    const KILOGRAM = 2;
    const GRAM     = 3;

    public static function getToForm()
    {
        return [
            [
                'id'   => UnityType::UNITY,
                'name' => 'Unidade'
            ],
            [
                'id'   => UnityType::KILOGRAM,
                'name' => 'Kg'
            ],
            [
                'id'   => UnityType::GRAM,
                'name' => 'g'
            ]
        ];
    }
}
