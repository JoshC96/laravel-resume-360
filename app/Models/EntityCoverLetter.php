<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string $content
 * @property int $user_id
 * @property Carbon $updated_at
 * @property-read Entity $entity
 * @property-read Carbon $created_at
 */
class EntityCoverLetter extends Model
{
    public const TABLE = 'entity_cover_letters';

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_DESCRIPTION = 'content';
    public const FIELD_ENTITY_ID = 'entity_id';

    public const RELATION_ENTITY = 'entity';

    protected $table = self::TABLE;
    protected $guarded = [
        self::FIELD_ID
    ];


    /**
     * @return BelongsTo 
     */
    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::TABLE, self::FIELD_ENTITY_ID, Entity::FIELD_ID);
    }
}
