<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $payload
 * @property string $content
 * @property string $prompt
 * @property int $prompt_id
 * @property string $source
 * @property string $model
 * @property string $remote_id
 * @property-read Carbon $created_at
 */
class AiResponse extends Model
{
    use HasFactory;

    public const TABLE = 'ai_responses';

    public const FIELD_ID = 'id';
    public const FIELD_PAYLOAD = 'payload';
    public const FIELD_CONTENT = 'content';
    public const FIELD_SOURCE = 'source';
    public const FIELD_REMOTE_ID = 'remote_id';
    public const FIELD_MODEL = 'model';
    public const FIELD_PROMPT_ID = 'prompt_id';

    public const RELATION_PROMPT = 'prompt';


    protected $table = self::TABLE;
    protected $guarded = [
        self::FIELD_ID
    ];


    /**
     * @return HasOne
     */
    public function prompt(): HasOne
    {
        return $this->hasOne(Prompt::class, self::FIELD_PROMPT_ID, Prompt::FIELD_ID);
    }


}
