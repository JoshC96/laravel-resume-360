<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property int $type
 * @property string|null $description
 * @property int|null $employee_size
 * @property Carbon $updated_at
 * @property-read Collection|null $locations
 * @property-read Collection|null $contacts
 * @property-read Carbon $created_at
 */
class Entity extends Model
{
    public const TABLE = 'entities';

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_TYPE = 'type';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_EMPLOYEE_SIZE = 'employee_size';

    public const RELATION_LOCATIONS = 'locations';
    public const RELATION_CONTACTS = 'contacts';
    
    /**
     * @return HasMany 
     */
    public function locations(): HasMany
    {
        return $this->hasMany(EntityLocation::TABLE);
    }

    /**
     * @return HasMany 
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(EntityContact::TABLE);
    }
}
