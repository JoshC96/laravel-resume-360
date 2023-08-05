<?php

namespace App\Http\Requests\WorkExperience;

use App\Models\User;
use App\Models\UserWorkExperience;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateWorkExperienceRequest extends FormRequest
{

    public const REQUEST_NAME = UserWorkExperience::FIELD_NAME;
    public const REQUEST_POSITION = UserWorkExperience::FIELD_POSITION;
    public const REQUEST_DESCRIPTION = UserWorkExperience::FIELD_DESCRIPTION;
    public const REQUEST_STARTED_AT = UserWorkExperience::FIELD_STARTED_AT;
    public const REQUEST_FINISHED_AT = UserWorkExperience::FIELD_FINISHED_AT;
    public const REQUEST_USER_ID = UserWorkExperience::FIELD_USER_ID;
    public const REQUEST_ENTITY_ID = UserWorkExperience::FIELD_ENTITY_ID;


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
            self::REQUEST_NAME => ['string', 'sometimes', 'max:100'],
            self::REQUEST_POSITION => ['string', 'sometimes', 'max:100'],
            self::REQUEST_DESCRIPTION => ['string', 'sometimes', 'max:500'],
            self::REQUEST_STARTED_AT => ['string', 'sometimes'],
            self::REQUEST_FINISHED_AT => ['string', 'sometimes'],
            self::REQUEST_USER_ID => ['numeric', 'sometimes', Rule::exists(User::TABLE, User::FIELD_ID)],
            self::REQUEST_ENTITY_ID => ['numeric', 'sometimes'],
        ];
    }
}
