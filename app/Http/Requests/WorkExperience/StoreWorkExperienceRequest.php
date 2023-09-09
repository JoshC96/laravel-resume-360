<?php

namespace App\Http\Requests\WorkExperience;

use App\Models\User;
use App\Models\UserWorkExperience;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreWorkExperienceRequest extends FormRequest
{

    public const REQUEST_NAME = UserWorkExperience::FIELD_NAME;
    public const REQUEST_POSITION = UserWorkExperience::FIELD_POSITION;
    public const REQUEST_DESCRIPTION = UserWorkExperience::FIELD_DESCRIPTION;
    public const REQUEST_STARTED_MONTH = UserWorkExperience::FIELD_STARTED_MONTH;
    public const REQUEST_STARTED_YEAR = UserWorkExperience::FIELD_STARTED_YEAR;
    public const REQUEST_FINISHED_MONTH = UserWorkExperience::FIELD_FINISHED_MONTH;
    public const REQUEST_FINISHED_YEAR = UserWorkExperience::FIELD_FINISHED_YEAR;
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
            self::REQUEST_NAME => ['string', 'nullable'],
            self::REQUEST_POSITION => ['string', 'required'],
            self::REQUEST_DESCRIPTION => ['string','required'],
            self::REQUEST_STARTED_MONTH => ['numeric', 'required'],
            self::REQUEST_STARTED_YEAR => ['numeric', 'required'],
            self::REQUEST_FINISHED_MONTH => ['numeric', 'required'],
            self::REQUEST_FINISHED_YEAR => ['numeric', 'required'],
            self::REQUEST_USER_ID => ['numeric', 'sometimes', Rule::exists(User::TABLE, User::FIELD_ID)],
            self::REQUEST_ENTITY_ID => ['numeric', 'sometimes'],
        ];
    }
}
