<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
 * @property-read Collection|null $jobs
 * @property-read Carbon $created_at
 */
class Entity extends Model
{
    use HasFactory;

    public const TABLE = 'entities';

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_TYPE = 'type';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_EMPLOYEE_SIZE = 'employee_size';

    public const RELATION_LOCATIONS = 'locations';
    public const RELATION_CONTACTS = 'contacts';
    public const RELATION_JOBS = 'jobs';

    protected $table = self::TABLE;
    protected $guarded = [
        self::FIELD_ID
    ];

    
    /**
     * @return HasMany 
     */
    public function locations(): HasMany
    {
        return $this->hasMany(EntityLocation::class);
    }

    /**
     * @return HasMany 
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(EntityContact::class);
    }

    /**
     * @return HasMany 
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(JobListing::class);
    }
}
