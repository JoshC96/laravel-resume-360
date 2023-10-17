<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property string|null $position
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $description
 * @property int $user_id 
 * @property int $entity_id
 * @property Carbon $updated_at
 * @property-read User $user
 * @property-read Entity|null $entity
 * @property-read Carbon $created_at
 */
class UserReferee extends Model
{
    public const TABLE = 'user_referees';

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_POSITION = 'position';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_PHONE = 'phone';
    public const FIELD_EMAIL = 'email';
    public const FIELD_ENTITY = 'entity';
    public const FIELD_USER_ID = 'user_id';

    public const RELATION_USER = 'user';

    protected $table = self::TABLE;
    protected $guarded = [
        self::FIELD_ID
    ];

    /**
     * @return BelongsTo 
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::FIELD_USER_ID, User::FIELD_ID);
    }
}
