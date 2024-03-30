<?php

declare(strict_types = 1);

namespace App\Enums;

enum Discount: int
{
    case No      = 0;
    case Low     = 5;
    case Medium  = 10;
    case High    = 15;
    case Higher  = 20;
    case Highest = 25;

    public static function toArray(): array
    {
        return array_map(
            fn (self $discount): int => $discount->value,
            self::cases()
        );
    }
}
