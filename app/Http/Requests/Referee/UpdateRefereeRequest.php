<?php

namespace App\Http\Requests\Referee;

use App\Models\User;
use App\Models\UserReferee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateRefereeRequest extends FormRequest
{

    public const REQUEST_NAME = UserReferee::FIELD_NAME;
    public const REQUEST_POSITION = UserReferee::FIELD_POSITION;
    public const REQUEST_DESCRIPTION = UserReferee::FIELD_DESCRIPTION;
    public const REQUEST_PHONE = UserReferee::FIELD_PHONE;
    public const REQUEST_EMAIL = UserReferee::FIELD_EMAIL;
    public const REQUEST_USER_ID = UserReferee::FIELD_USER_ID;
    public const REQUEST_ORGANISATION = UserReferee::FIELD_ENTITY;


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
            self::REQUEST_DESCRIPTION => ['string','sometimes', 'max:500'],
            self::REQUEST_PHONE => ['string', 'sometimes', 'max:15'],
            self::REQUEST_EMAIL => ['email:rfc,dns','sometimes', 'max:75'],
            self::REQUEST_USER_ID => ['numeric', 'sometimes', Rule::exists(User::TABLE, User::FIELD_ID)],
            self::REQUEST_ORGANISATION => ['string', 'nullable',  'sometimes'],
        ];
    }
}
