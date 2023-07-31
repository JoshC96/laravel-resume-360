<?php

namespace App\Models;

use App\Models\UserResume as ModelsUserResume;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $status
 * @property int $apply_with_profile
 * @property Carbon|null $applied_at 
 * @property Carbon|null $viewed_at
 * @property int $user_id 
 * @property int $job_listing_id 
 * @property int|null $cover_letter_id 
 * @property int|null $resume_id 
 * @property Carbon $updated_at
 * @property-read User $user
 * @property-read JobListing $jobListing
 * @property-read UserResume|null $resume
 * @property-read UserCoverLetter|null $coverLetter
 * @property-read Carbon $created_at
 */
class UserJobApplication extends Model
{
    public const TABLE = 'user_job_applications';

    public const FIELD_ID = 'id';
    public const FIELD_STATUS = 'status';
    public const FIELD_APPLIED_WITH_PROFILE = 'apply_with_profile';
    public const FIELD_APPLIED_AT = 'applied_at';
    public const FIELD_VIEWED_AT = 'viewed_at';
    public const FIELD_USER_ID = 'user_id';
    public const FIELD_JOB_LISTING_ID = 'job_listing_id';
    public const FIELD_COVER_LETTER_ID = 'cover_letter_id';
    public const FIELD_RESUME_ID = 'resume_id';

    public const RELATION_USER = 'user';
    public const RELATION_RESUME = 'resume';
    public const RELATION_COVER_LETTER = 'coverLetter';
    public const RELATION_JOB_LISTING = 'jobListing';

    /**
     * @return BelongsTo 
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::TABLE, self::FIELD_USER_ID, User::FIELD_ID);
    }

    /**
     * @return HasOne 
     */
    public function jobListing(): HasOne
    {
        return $this->hasOne(JobListing::TABLE, self::FIELD_JOB_LISTING_ID, JobListing::FIELD_ID);
    }

    /**
     * @return HasOne 
     */
    public function resume(): HasOne
    {
        return $this->hasOne(UserResume::TABLE, self::FIELD_RESUME_ID, UserResume::FIELD_ID);
    }

    /**
     * @return HasOne 
     */
    public function coverLetter(): HasOne
    {
        return $this->hasOne(UserCoverLetter::TABLE, self::FIELD_COVER_LETTER_ID, UserCoverLetter::FIELD_ID);
    }
}
