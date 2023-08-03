<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @property int $id
 * @property bool $is_public
 * @property int $user_id 
 * @property Carbon $updated_at
 * @property-read User $user
 * @property-read Carbon $created_at
 */
class UserResume extends Model
{
    public const TABLE = 'user_resumes';

    public const FIELD_ID = 'id';
    public const FIELD_IS_PUBLIC = 'is_public';
    public const FIELD_USER_ID = 'user_id';

    public const RELATION_USER = 'user';
    public const RELATION_QUALIFICATIONS = 'qualifications';
    public const RELATION_WORK_EXPERIENCES = 'workExperiences';
    public const RELATION_PUBLICATIONS = 'publications';
    public const RELATION_REFEREES = 'referees';
    public const RELATION_LICENCES = 'licences';
    public const RELATION_CERTIFICATIONS = 'certifications';

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
