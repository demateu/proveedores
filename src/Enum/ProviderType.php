<?php

namespace App\Enum;

class ProviderType
{
    public const HOTEL = 'hotel';
    public const PISTA = 'pista';
    public const COMPLEMENTO = 'complemento';

    public const TYPES = [
        self::HOTEL,
        self::PISTA,
        self::COMPLEMENTO,
    ];

    public static function isValidType(string $type): bool
    {
        return in_array($type, self::TYPES, true);
    }
}
