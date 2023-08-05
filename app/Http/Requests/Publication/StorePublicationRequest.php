<?php

namespace App\Http\Requests\Publication;

use App\Models\User;
use App\Models\UserPublication;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StorePublicationRequest extends FormRequest
{
    public const REQUEST_NAME = UserPublication::FIELD_NAME;
    public const REQUEST_DESCRIPTION = UserPublication::FIELD_DESCRIPTION;
    public const REQUEST_PUBLISHED_AT = UserPublication::FIELD_PUBLISHED_AT;
    public const REQUEST_USER_ID = UserPublication::FIELD_USER_ID;

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
            self::REQUEST_DESCRIPTION => ['string', 'required', 'max:500'],
            self::REQUEST_PUBLISHED_AT => ['string', 'required'],
            self::REQUEST_USER_ID => ['numeric', 'sometimes', Rule::exists(User::TABLE, User::FIELD_ID)],
        ];
    }
}
