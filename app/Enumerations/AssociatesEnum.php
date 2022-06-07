<?php

namespace App\Enumerations;

class AssociatesEnum
{
    public const FRIEND = 'Friend';
    public const ENEMY = 'Enemy';
    public const ACQUAINTANCE = 'Acquaintance';
    public const CONTACT = 'Contact';

    public static function associateTypes(): array
    {
        return [
            self::FRIEND,
            self::ENEMY,
            self::CONTACT,
            self::ACQUAINTANCE,
        ];
    }
}
