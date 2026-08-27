<?php

namespace App\Models\Enum;

enum PropertyStatus: string
{
    case Draft = 'draft';
    case Published = 'published';
    case Disabled = 'disabled';
    case Deleted = 'deleted';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
