<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string|null $state
 * @property string|null $country
 * @property string|null $postal_code
 * @property string|null $latitude
 * @property string|null $longitude
 * @property Carbon $updated_at
 * @property-read Carbon $created_at
 */
class Location extends Model
{
    use HasFactory;

    public const TABLE = 'locations';

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_ADDRESS = 'address';
    public const FIELD_CITY = 'city';
    public const FIELD_STATE = 'state';
    public const FIELD_COUNTRY = 'country';
    public const FIELD_POSTAL_CODE = 'postal_code';
    public const FIELD_LATITUDE = 'latitude';
    public const FIELD_LONGITUDE = 'longitude';

    protected $table = self::TABLE;
    protected $guarded = [
        self::FIELD_ID
    ];


    
}
