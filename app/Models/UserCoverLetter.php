<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string $content
 * @property int $user_id
 * @property Carbon $updated_at
 * @property-read User $user
 * @property-read Carbon $created_at
 */
class UserCoverLetter extends Model
{
    public const TABLE = 'user_cover_letters';

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_DESCRIPTION = 'content';
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
