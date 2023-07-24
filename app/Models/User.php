<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * 
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

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
    
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
}
