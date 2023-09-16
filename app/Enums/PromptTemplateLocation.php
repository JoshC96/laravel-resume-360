<?php

namespace App\Enums;

enum PromptTemplateLocation: int
{
    case COVER_LETTER = 1;
    case RESUME = 2;
    case EMAIL = 3;

    /**
     * @param int $value 
     * @return string|null 
     */
    public static function getDisplayString(int $value): ?string
    {
        return match ($value) {
            self::COVER_LETTER->value => 'Cover Letter',
            self::RESUME->value => 'Resume',
            self::EMAIL->value => 'Email',
        };
    }
}