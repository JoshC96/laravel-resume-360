<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $payload
 * @property string $content
 * @property-read Carbon $created_at
 */
class AiResponse extends Model
{
    use HasFactory;

    public const TABLE = 'ai_responses';

    public const FIELD_ID = 'id';
    public const FIELD_PAYLOAD = 'payload';
    public const FIELD_CONTENT = 'content';
    public const FIELD_PROMPT = 'prompt';
    public const FIELD_SOURCE = 'source';
    public const FIELD_REMOTE_ID = 'remote_id';
    public const FIELD_MODEL = 'model';

    protected $table = self::TABLE;
    protected $guarded = [
        self::FIELD_ID
    ];


}
