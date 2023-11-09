<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property string|null $bio
 * @property string|null $date_of_birth
 * @property string|null $mobile_phone
 * @property string|null $work_phone
 * @property string|null $website
 * @property string|null $address
 * @property string|null $current_role
 * @property string|null $location
 * @property Carbon $updated_at
 * @property-read Carbon $created_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    public const TABLE = 'users';

    public const FIELD_ID = 'id';
    public const FIELD_UUID = 'uuid';
    public const FIELD_NAME = 'name';
    public const FIELD_EMAIL = 'email';
    public const FIELD_VERIFIED_AT = 'email_verified_at';
    public const FIELD_PASSWORD = 'password';
    public const FIELD_BIO = 'bio';
    public const FIELD_DATE_OF_BIRTH = 'date_of_birth';
    public const FIELD_MOBILE = 'mobile_phone';
    public const FIELD_WORK_PHONE = 'work_phone';
    public const FIELD_WEBSITE = 'website';
    public const FIELD_ADDRESS = 'address';
    public const FIELD_CURRENT_ROLE = 'current_role';
    public const FIELD_LOCATION = 'location';
    public const FIELD_PROVIDER_ID = 'provider_id';

    public const RELATION_REFEREES = 'referees';
    public const RELATION_WORK_EXPERIENCES = 'workExperiences';
    public const RELATION_QUALIFICATIONS = 'qualifications';
    public const RELATION_PUBLICATIONS = 'publications';
    public const RELATION_LICENCES = 'licences';
    public const RELATION_CERTIFICATIONS = 'certifications';
    public const RELATION_ENTITY_CONTACT = 'entityContact';
    public const RELATION_COVER_LETTERS = 'coverLetters';
    public const RELATION_RESUMES = 'resumes';
    public const RELATION_JOB_APPLICATIONS = 'jobApplications';
    public const RELATION_PROVIDER = 'provider';

    protected $table = self::TABLE;
    protected $guarded = [
        self::FIELD_ID,
        self::FIELD_PASSWORD
    ];

    protected $guard_name = 'api';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function (User $user) {
            $user->{User::FIELD_UUID} = (string) Str::uuid();
        });
    }

    /**
     * @return HasMany 
     */
    public function referees(): HasMany
    {
        return $this->hasMany(UserReferee::class, UserReferee::FIELD_USER_ID, self::FIELD_ID);
    }

    /**
     * @return HasMany 
     */
    public function workExperiences(): HasMany
    {
        return $this->hasMany(UserWorkExperience::class, UserWorkExperience::FIELD_USER_ID, self::FIELD_ID);
    }

    /**
     * @return HasMany 
     */
    public function qualifications(): HasMany
    {
        return $this->hasMany(UserQualification::class, UserQualification::FIELD_USER_ID, self::FIELD_ID);
    }

    /**
     * @return HasMany 
     */
    public function publications(): HasMany
    {
        return $this->hasMany(UserPublication::class, UserPublication::FIELD_USER_ID, self::FIELD_ID);
    }

    /**
     * @return HasMany 
     */
    public function licences(): HasMany
    {
        return $this->hasMany(UserLicence::class, UserLicence::FIELD_USER_ID, self::FIELD_ID);
    }

    /**
     * @return HasMany 
     */
    public function certifications(): HasMany
    {
        return $this->hasMany(UserCertification::class, UserCertification::FIELD_USER_ID, self::FIELD_ID);
    }

    /**
     * @return HasMany 
     */
    public function coverLetters(): HasMany
    {
        return $this->hasMany(UserCoverLetter::class, UserCoverLetter::FIELD_USER_ID, self::FIELD_ID);
    }

    /**
     * @return HasMany 
     */
    public function resumes(): HasMany
    {
        return $this->hasMany(UserResume::class, UserResume::FIELD_USER_ID, self::FIELD_ID);
    }

    /**
     * @return HasMany 
     */
    public function jobApplications(): HasMany
    {
        return $this->hasMany(UserJobApplication::class, UserResume::FIELD_USER_ID, self::FIELD_ID);
    }

    /**
     * @return HasOne 
     */
    public function provider(): HasOne
    {
        return $this->hasOne(Entity::class, Entity::FIELD_ID, self::FIELD_PROVIDER_ID);
    }
}
