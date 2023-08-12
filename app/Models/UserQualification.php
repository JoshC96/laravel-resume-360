<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property string $field
 * @property string $grade
 * @property string $description
 * @property int|null $location_id
 * @property int|null $entity_id
 * @property int $user_id
 * @property Carbon|null $started_at
 * @property Carbon|null $finished_at
 * @property Carbon $updated_at
 * @property-read User $user
 * @property-read Location|null $location
 * @property-read Entity|null $entity
 * @property-read Carbon $created_at
 */
class UserQualification extends Model
{
    public const TABLE = 'user_qualifications';

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_INDUSTRY = 'field';
    public const FIELD_GRADE = 'grade';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_STARTED_MONTH = 'started_month';
    public const FIELD_STARTED_YEAR = 'started_year';
    public const FIELD_FINISHED_MONTH = 'finished_month';
    public const FIELD_FINISHED_YEAR = 'finished_year';
    public const FIELD_LOCATION_ID = 'location_id';
    public const FIELD_ENTITY_ID = 'entity_id';
    public const FIELD_USER_ID = 'user_id';

    public const RELATION_LOCATION = 'location';
    public const RELATION_ENTITY = 'entity';
    public const RELATION_USER = 'user';

    protected $table = self::TABLE;
    protected $guarded = [
        self::FIELD_ID
    ];

    
    /**
     * @return HasOne 
     */
    public function location(): HasOne
    {
        return $this->hasOne(Location::TABLE, self::FIELD_LOCATION_ID, Location::FIELD_ID);
    }

    /**
     * @return HasOne 
     */
    public function entity(): HasOne
    {
        return $this->hasOne(Entity::TABLE, self::FIELD_ENTITY_ID, Entity::FIELD_ID);
    }

    /**
     * @return BelongsTo 
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::TABLE, self::FIELD_USER_ID, User::FIELD_ID);
    }
}
