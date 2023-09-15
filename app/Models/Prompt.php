<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $content
 * @property int $created_by_id
 * @property int $template_id
 * @property-read PromptTemplate $template
 * @property-read AiResponse $response
 * @property-read User $createdBy
 * @property-read Carbon $created_at
 */
class Prompt extends Model 
{
    use HasFactory;

    public const TABLE = 'prompts';

    public const FIELD_ID = 'id';
    public const FIELD_CONTENT = 'content';
    public const FIELD_CREATED_BY_ID = 'created_by_id';
    public const FIELD_TEMPLATE_ID = 'template_id';

    public const RELATION_CREATED_BY = 'createdBy';
    public const RELATION_TEMPLATE = 'template';
    public const RELATION_RESPONSE = 'response';

    protected $table = self::TABLE;
    protected $guarded = [
        self::FIELD_ID
    ];

    /**
     * @return HasOne
     */
    public function createdBy(): HasOne
    {
        return $this->hasOne(User::class, User::FIELD_ID, self::FIELD_CREATED_BY_ID);
    }


    /**
     * @return HasOne
     */
    public function response(): HasOne
    {
        return $this->hasOne(AiResponse::class, AiResponse::FIELD_PROMPT_ID);
    }


    /**
     * @return BelongsTo 
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(PromptTemplate::class, self::FIELD_TEMPLATE_ID, PromptTemplate::FIELD_ID);
    }
}