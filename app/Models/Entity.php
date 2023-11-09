<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

/**
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property int $type
 * @property string|null $description
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $website
 * @property string $industry
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
    public const FIELD_UUID = 'uuid';
    public const FIELD_NAME = 'name';
    public const FIELD_TYPE = 'type';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_EMPLOYEE_SIZE = 'employee_size';
    public const FIELD_WEBSITE = 'website';
    public const FIELD_PHONE = 'phone';
    public const FIELD_EMAIL = 'email';
    public const FIELD_INDUSTRY = 'industry';

    public const RELATION_LOCATIONS = 'locations';
    public const RELATION_CONTACTS = 'contacts';
    public const RELATION_JOBS = 'jobs';
    public const RELATION_APPLICATIONS = 'applications';

    protected $table = self::TABLE;
    protected $guarded = [
        self::FIELD_ID
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function (Entity $entity) {
            $entity->{Entity::FIELD_UUID} = (string) Str::uuid();
        });
    }

    
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

    /**
     * @return HasManyThrough
     */
    public function applications(): HasManyThrough
    {
        return $this->hasManyThrough(UserJobApplication::class, JobListing::class);
    }

    /**
     * @return HasMany 
     */
    public function providerUsers(): HasMany
    {
        return $this->hasMany(User::class, User::FIELD_PROVIDER_ID, self::FIELD_ID);
    }

}
