<?php

namespace App\Http\Requests\Certification;

use App\Models\User;
use App\Models\UserCertification;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateCertificationRequest extends FormRequest
{

    public const REQUEST_NAME = UserCertification::FIELD_NAME;
    public const REQUEST_DESCRIPTION = UserCertification::FIELD_DESCRIPTION;
    public const REQUEST_ISSUED_MONTH = UserCertification::FIELD_ISSUED_MONTH;
    public const REQUEST_ISSUED_YEAR = UserCertification::FIELD_ISSUED_YEAR;
    public const REQUEST_USER_ID = UserCertification::FIELD_USER_ID;


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
            self::REQUEST_DESCRIPTION => ['string', 'sometimes', 'max:500'],
            self::REQUEST_ISSUED_MONTH => ['numeric', 'sometimes'],
            self::REQUEST_ISSUED_YEAR => ['numeric', 'sometimes'],
            self::REQUEST_USER_ID => ['numeric', 'sometimes', Rule::exists(User::TABLE, User::FIELD_ID)],
        ];
    }
}
