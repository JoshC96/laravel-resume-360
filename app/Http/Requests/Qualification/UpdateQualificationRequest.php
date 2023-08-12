<?php

namespace App\Http\Requests\Qualification;

use App\Models\User;
use App\Models\UserQualification;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateQualificationRequest extends FormRequest
{

    public const REQUEST_NAME = UserQualification::FIELD_NAME;
    public const REQUEST_INDUSTRY = UserQualification::FIELD_INDUSTRY;
    public const REQUEST_DESCRIPTION = UserQualification::FIELD_DESCRIPTION;
    public const REQUEST_STARTED_MONTH = UserQualification::FIELD_STARTED_MONTH;
    public const REQUEST_STARTED_YEAR = UserQualification::FIELD_STARTED_YEAR;
    public const REQUEST_FINISHED_MONTH = UserQualification::FIELD_FINISHED_MONTH;
    public const REQUEST_FINISHED_YEAR = UserQualification::FIELD_FINISHED_YEAR;
    public const REQUEST_GRADE = UserQualification::FIELD_GRADE;
    public const REQUEST_USER_ID = UserQualification::FIELD_USER_ID;
    public const REQUEST_ENTITY_ID = UserQualification::FIELD_ENTITY_ID;
    public const REQUEST_COMPANY = 'company';

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
            self::REQUEST_INDUSTRY => ['string', 'sometimes', 'max:100'],
            self::REQUEST_DESCRIPTION => ['string', 'sometimes', 'max:500'],
            self::REQUEST_GRADE => ['string', 'sometimes', 'max:15'],
            self::REQUEST_STARTED_MONTH => ['numeric', 'sometimes'],
            self::REQUEST_STARTED_YEAR => ['numeric', 'sometimes'],
            self::REQUEST_FINISHED_MONTH => ['numeric', 'sometimes'],
            self::REQUEST_FINISHED_YEAR => ['numeric', 'sometimes'],
            self::REQUEST_USER_ID => ['numeric', 'sometimes', Rule::exists(User::TABLE, User::FIELD_ID)],
            self::REQUEST_ENTITY_ID => ['numeric', 'sometimes'],
            self::REQUEST_COMPANY => ['string', 'sometimes'],
        ];
    }
}
