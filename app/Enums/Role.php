<?php

declare(strict_types=1);

namespace App\Enums;

enum Role
{
    case MANAGER;
    case SELLER;

    /**
     * @return string[]
     */
    public static function toArray(): array
    {
        return array_map(
            fn (self $role): string => $role->name,
            self::cases()
        );
    }
}
