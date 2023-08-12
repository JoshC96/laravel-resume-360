<?php

namespace App\Http\Requests\Licence;

use App\Models\User;
use App\Models\UserLicence;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreLicenceRequest extends FormRequest
{
    public const REQUEST_NAME = UserLicence::FIELD_NAME;
    public const REQUEST_DESCRIPTION = UserLicence::FIELD_DESCRIPTION;
    public const REQUEST_ISSUED_MONTH = UserLicence::FIELD_ISSUED_MONTH;
    public const REQUEST_ISSUED_YEAR = UserLicence::FIELD_ISSUED_YEAR;
    public const REQUEST_USER_ID = UserLicence::FIELD_USER_ID;

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
            self::REQUEST_NAME => ['string', 'required', 'max:100'],
            self::REQUEST_DESCRIPTION => ['string', 'sometimes', 'max:500'],
            self::REQUEST_ISSUED_MONTH => ['string', 'required'],
            self::REQUEST_ISSUED_YEAR => ['string', 'required'],
            self::REQUEST_USER_ID => ['numeric', 'sometimes', Rule::exists(User::TABLE, User::FIELD_ID)],
        ];
    }
}
