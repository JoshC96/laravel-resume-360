<?php

namespace App\Enums;

enum PromptTemplateStatus: int
{
    case DRAFT = 1;
    case ACTIVE = 2;
    case ARCHIVED = 3;

    /**
     * @param int $value 
     * @return string|null 
     */
    public static function getDisplayString(int $value): ?string
    {
        return match ($value) {
            self::DRAFT->value => 'Draft',
            self::ACTIVE->value => 'Active',
            self::ARCHIVED->value => 'Archived',
        };
    }
}