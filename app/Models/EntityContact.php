<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property string $position
 * @property string|null $description
 * @property string|null $phone
 * @property string|null $email
 * @property int|null $user_id
 * @property int $entity_id
 * @property Carbon $updated_at
 * @property-read User|null $location
 * @property-read Entity $entity
 * @property-read Carbon $created_at
 */
class EntityContact extends Model
{
    use HasFactory;

    public const TABLE = 'entity_contacts';

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_POSITION = 'position';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_PHONE = 'phone';
    public const FIELD_EMAIL = 'email';
    public const FIELD_USER_ID = 'user_id';
    public const FIELD_ENTITY_ID = 'entity_id';

    public const RELATION_USER = 'user';
    public const RELATION_ENTITY = 'entity';

    protected $table = self::TABLE;
    protected $guarded = [
        self::FIELD_ID
    ];


    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::TABLE, self::FIELD_USER_ID, User::FIELD_ID);
    }

    /**
     * @return BelongsTo 
     */
    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::TABLE, self::FIELD_ENTITY_ID, Entity::FIELD_ID);
    }
}
