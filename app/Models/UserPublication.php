<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $location_id
 * @property int $user_id
 * @property Carbon|null $published_at
 * @property Carbon $updated_at
 * @property-read User $user
 * @property-read Location|null $location
 * @property-read Carbon $created_at
 */
class UserPublication extends Model
{
    public const TABLE = 'user_publications';

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_PUBLISHED_AT = 'published_at';
    public const FIELD_LOCATION_ID = 'location_id';
    public const FIELD_USER_ID = 'user_id';

    public const RELATION_LOCATION = 'location';
    public const RELATION_USER = 'user';
    
    /**
     * @return HasOne 
     */
    public function location(): HasOne
    {
        return $this->hasOne(Location::TABLE, self::FIELD_LOCATION_ID, Location::FIELD_ID);
    }

    /**
     * @return BelongsTo 
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::TABLE, self::FIELD_USER_ID, User::FIELD_ID);
    }
}
