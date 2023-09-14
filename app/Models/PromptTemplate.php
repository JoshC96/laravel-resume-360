<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $content
 * @property int $created_by_id
 * @property-read Carbon $created_at
 */
class PromptTemplate extends Model 
{
    use HasFactory;

    public const TABLE = 'prompt_template';

    public const FIELD_ID = 'id';
    public const FIELD_CONTENT = 'content';
    public const FIELD_STATUS = 'status';
    public const FIELD_USE_LOCATION = 'use_location';
    public const FIELD_CREATED_BY_ID = 'created_by_id';
    public const FIELD_UPDATED_BY_ID = 'updated_by_id';

    public const RELATION_PROMPTS = 'prompts';
    public const RELATION_CREATED_BY = 'createdBy';
    public const RELATION_UPDATED_BY = 'updatedBy';


    public const STATUS_DRAFT = 1;
    public const STATUS_ACTIVE = 2;
    public const STATUS_ARCHIVED = 3;

    public const USE_LOCATION_COVER_LETTER = 1;
    public const USE_LOCATION_RESUME = 2;

    protected $table = self::TABLE;
    protected $guarded = [
        self::FIELD_ID
    ];

    public const PREMIUM_MAKE_COVER_LETTER = 'Use the following JSON data to create a cover letter for a job role as {{role}}. Exclude headers such as the date, name, and addresses. Ensure there are no details included in the cover letter that are false or not included on the profiled. The "name" key of the JSON is the applicants name, use this in the letter. The letter should be addressed to {{entity_contact}} {{user-profile}}';
    public const STANDARD_MAKE_COVER_LETTER = 'Use the following JSON data to create a cover letter for a job role as {{role}}. Exclude headers such as the date, name, and addresses.  The letter should be addressed to {{entity-contact}} {{user-profile}}';
    public const PREMIUM_MAKE_RESUME = 'Use the following JSON data to create a resume for a job role as {{role}}. {{user-profile}}';
    public const STANDARD_MAKE_RESUME = 'Use the following JSON data to create a resume for a job role as {{role}}. {{user-profile}}';

    public const STANDARD_TEST = 'What is a comedian name for someone with the name {{user-name}}';


    /**
     * @return HasOne
     */
    public function createdBy(): HasOne
    {
        return $this->hasOne(User::class, self::FIELD_CREATED_BY_ID, User::FIELD_ID);
    }

    /**
     * @return HasOne
     */
    public function FIELD_UPDATED_BY_ID(): HasOne
    {
        return $this->hasOne(User::class, self::FIELD_UPDATED_BY_ID, User::FIELD_ID);
    }

    /**
     * @return HasMany 
     */
    public function prompts(): HasMany
    {
        return $this->hasMany(Prompt::class);
    }

}