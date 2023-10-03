<?php

namespace App\Http\Requests\Entities;

use App\Enums\EntityType;
use App\Models\Entity;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EntityRequest extends FormRequest
{
    public const REQUEST_NAME = Entity::FIELD_NAME;
    public const REQUEST_DESCRIPTION = Entity::FIELD_DESCRIPTION;
    public const REQUEST_TYPE = Entity::FIELD_TYPE;
    public const REQUEST_EMPLOYEES = Entity::FIELD_EMPLOYEE_SIZE;
    public const REQUEST_USER_ID = 'user_id';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user() ? true : false;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            self::REQUEST_NAME => ['string', 'nullable'],
            self::REQUEST_DESCRIPTION => ['string', 'nullable'],
            self::REQUEST_TYPE => ['numeric', 'nullable', Rule::in(array_column(EntityType::cases(), 'value'))],
            self::REQUEST_EMPLOYEES => ['numeric', 'nullable'],
            self::REQUEST_USER_ID => ['numeric', 'nullable', Rule::exists(User::TABLE, User::FIELD_ID)],
        ];
    }
}
