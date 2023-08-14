<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $user_id
 * @property int $issued_month
 * @property int $issued_year
 * @property Carbon $updated_at
 * @property-read User $user
 * @property-read Carbon $created_at
 */
class UserCertification extends Model
{
    public const TABLE = 'user_certifications';

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_ISSUED_MONTH = 'issued_month';
    public const FIELD_ISSUED_YEAR = 'issued_year';
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
        return $this->belongsTo(User::TABLE, self::FIELD_USER_ID, User::FIELD_ID);
    }
}
