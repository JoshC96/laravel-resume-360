<?php

namespace App\Http\Requests\PromptTemplates;

use App\Enums\PromptTemplateLocation;
use App\Enums\PromptTemplateStatus;
use App\Models\PromptTemplate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdatePromptTemplateRequest extends FormRequest
{
    public const REQUEST_CONTENT = PromptTemplate::FIELD_CONTENT;
    public const REQUEST_USE_LOCATION = PromptTemplate::FIELD_USE_LOCATION;
    public const REQUEST_FIELD_STATUS = PromptTemplate::FIELD_STATUS;


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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            self::REQUEST_CONTENT => ['string', 'sometimes'],
            self::REQUEST_USE_LOCATION => ['int', 'sometimes', Rule::in(array_column(PromptTemplateLocation::cases(), 'value'))],
            self::REQUEST_FIELD_STATUS => ['int', 'sometimes', Rule::in(array_column(PromptTemplateStatus::cases(), 'value'))],
        ];
    }
}
