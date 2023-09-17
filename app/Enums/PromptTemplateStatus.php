<?php

namespace App\Enums;

enum PromptTemplateStatus: int
{
    case ACTIVE = 1;
    case DRAFT = 2;
    case ARCHIVED = 3;

    /**
     * @param int $value 
     * @return string|null 
     */
    public static function getDisplayString(int $value): ?string
    {
        return match ($value) {
            self::ACTIVE->value => 'Active',
            self::DRAFT->value => 'Draft',
            self::ARCHIVED->value => 'Archived',
        };
    }
}