<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property int $type
 * @property string|null $description
 * @property boolean $is_primary
 * @property int $location_id
 * @property int $entity_id
 * @property Carbon $updated_at
 * @property-read Location $location
 * @property-read Entity $entity
 * @property-read Carbonnull $created_at
 */
class EntityLocation extends Model
{
    use HasFactory;

    public const TABLE = 'entity_locations';

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_TYPE = 'type';
    public const FIELD_IS_PRIMARY = 'is_primary';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_LOCATION_ID = 'location_id';
    public const FIELD_ENTITY_ID = 'entity_id';

    public const RELATION_LOCATION = 'location';
    public const RELATION_ENTITY = 'entity';

    protected $table = self::TABLE;
    protected $guarded = [
        self::FIELD_ID
    ];

    
    /**
     * @return HasOne
     */
    public function location(): HasOne
    {
        return $this->hasOne(Location::class, Location::FIELD_ID, self::FIELD_LOCATION_ID);
    }

    /**
     * @return BelongsTo 
     */
    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class, self::FIELD_ENTITY_ID, Entity::FIELD_ID);
    }
}
