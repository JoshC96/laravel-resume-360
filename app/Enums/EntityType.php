<?php

namespace App\Enums;

enum EntityType: int
{
    case NONE = 0;
    case PROVIDER = 1;
    case RECRUITER = 2;
    case SMALL_BUSINESS = 3;
    case CORPORATION = 4;
    case PARTNERSHIP = 5; 
    case NON_PROFIT = 6; 
    case GOVERNMENT_ENTITY = 7;
    case SOLE_TRADER = 8;
    
    /**
     * @param int $value 
     * @return string|null 
     */
    public static function getDisplayString(int $value): ?string
    {
        return match ($value) {
            self::NONE->value => 'None',
            self::RECRUITER->value => 'Recruiter',
            self::PROVIDER->value => 'Provider',
            self::SMALL_BUSINESS->value => 'Small Business',
            self::CORPORATION->value => 'Corporation',
            self::PARTNERSHIP->value => 'Partnership',
            self::NON_PROFIT->value => 'Non-Profit',
            self::GOVERNMENT_ENTITY->value => 'Government Entity',
            self::SOLE_TRADER->value => 'Sole Trader',
        };
    }
}