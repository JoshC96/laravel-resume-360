<?php

namespace App\Enums;

enum EntityType: int
{
    case NONE = 0;
    case RECRUITER = 1;
    case SMALL_BUSINESS = 2;
    case CORPORATION = 3;
    case PARTNERSHIP = 4; 
    case NON_PROFIT = 5; 
    case GOVERNMENT_ENTITY = 6;
    case SOLE_TRADER = 7;
    
    /**
     * @param int $value 
     * @return string|null 
     */
    public static function getDisplayString(int $value): ?string
    {
        return match ($value) {
            self::NONE->value => 'None',
            self::RECRUITER->value => 'Recruiter',
            self::SMALL_BUSINESS->value => 'Small Business',
            self::CORPORATION->value => 'Corporation',
            self::PARTNERSHIP->value => 'Partnership',
            self::NON_PROFIT->value => 'Non-Profit',
            self::GOVERNMENT_ENTITY->value => 'Government Entity',
            self::SOLE_TRADER->value => 'Sole Trader',
        };
    }
}