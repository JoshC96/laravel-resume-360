<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $content
 * @property-read Carbon $created_at
 */
class Prompt extends Model 
{
    use HasFactory;

    public const TABLE = 'prompts';

    public const FIELD_ID = 'id';
    public const FIELD_CONTENT = 'content';

    protected $table = self::TABLE;
    protected $guarded = [
        self::FIELD_ID
    ];

    public const PREMIUM_MAKE_COVER_LETTER = 'Use the following JSON data to create a cover letter for a job role as {{role}}. The "name" key of the JSON is the applicants name, use this in the letter. The letter should be addressed to {{entity_contact}} {{user-profile}}';
    public const STANDARD_MAKE_COVER_LETTER = 'Use the following JSON data to create a cover letter for a job role as {{role}}. The letter should be addressed to {{entity-contact}} {{user-profile}}';
    public const PREMIUM_MAKE_RESUME = 'Use the following JSON data to create a resume for a job role as {{role}}. {{user-profile}}';
    public const STANDARD_MAKE_RESUME = 'Use the following JSON data to create a resume for a job role as {{role}}. {{user-profile}}';

    public const STANDARD_TEST = 'What is a comedian name for someone with the name {{user-name}}';
}