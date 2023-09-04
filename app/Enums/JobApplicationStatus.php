<?php

namespace App\Enums;

enum JobApplicationStatus: int
{
    case CANCELLED = 0;
    case INITIAL = 1;
    case GENERATING = 2;
    case APPLIED = 3;
    case VIEWED = 4;
    case ACCEPTED = 5;
    case UNSUCCESSFUL = 6;

    /**
     * @param int $value 
     * @return string|null 
     */
    public static function getDisplayString(int $value): ?string
    {
        return match ($value) {
            self::CANCELLED->value => 'Cancelled',
            self::INITIAL->value => 'Initial',
            self::GENERATING->value => 'Generating',
            self::APPLIED->value => 'Applied',
            self::VIEWED->value => 'Viewed',
            self::ACCEPTED->value => 'Accepted',
            self::UNSUCCESSFUL->value => 'Unsuccessful',
        };
    }
}