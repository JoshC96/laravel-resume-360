<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $uuid
 * @property string $title
 * @property string $industry
 * @property string $description
 * @property string $role
 * @property string|null $salary_min
 * @property int|null $salary_max
 * @property int|null $contract_type
 * @property int $entity_id
 * @property Carbon $updated_at
 * @property-read Entity $entity
 * @property-read Carbon $created_at
 */
class JobListing extends Model
{
    use HasFactory;

    public const TABLE = 'job_listings';

    public const FIELD_ID = 'id';
    public const FIELD_UUID = 'uuid';
    public const FIELD_TITLE = 'title';
    public const FIELD_INDUSTRY = 'industry';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_ROLE = 'role';
    public const FIELD_SALARY_MIN = 'salary_min';
    public const FIELD_SALARY_MAX = 'salary_max';
    public const FIELD_CONTRACT_TYPE = 'contract_type';
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
        return $this->belongsTo(Entity::class, self::FIELD_ENTITY_ID, Entity::FIELD_ID);
    }
}
