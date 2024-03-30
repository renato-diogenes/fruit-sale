<?php

declare(strict_types = 1);

namespace App\Enums;

enum FruitCategories
{
    case Exquisite;
    case Delicious;
    case Acceptable;
    case Poor_Quality;

    public static function toArray(): array
    {
        return array_map(
            fn (self $category): string => $category->name,
            self::cases()
        );
    }
}
