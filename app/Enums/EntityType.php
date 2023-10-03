<?php

namespace App\Enums;

enum EntityType: int
{
    case NONE = 0;
    case COMPANY = 1;
    case RECRUITER = 2;
    
    /**
     * @param int $value 
     * @return string|null 
     */
    public static function getDisplayString(int $value): ?string
    {
        return match ($value) {
            self::NONE->value => 'None',
            self::COMPANY->value => 'Company',
            self::RECRUITER->value => 'Recruiter',
        };
    }
}