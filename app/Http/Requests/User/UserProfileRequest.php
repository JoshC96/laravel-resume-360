<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserProfileRequest extends FormRequest
{

    public const REQUEST_USER_PROFILE = 'profile';
    public const REQUEST_BIO = 'bio';
    public const REQUEST_REFEREES = 'referees';
    public const REQUEST_WORK_HISTORY = 'workHistory';
    public const REQUEST_QUALFICATIONS = 'qualifications';
    public const REQUEST_CERTIFICATIONS = 'certifications';
    public const REQUEST_LICENSES = 'licenses';
    public const REQUEST_PUBLICATIONS = 'publications';


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
        ];
    }
}
