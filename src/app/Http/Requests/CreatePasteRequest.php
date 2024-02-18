<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

/**
 * @property string $title
 * @property string $text
 * @property int $authorId
 * @property int $programmingLanguageId
 * @property int $accessRestrictionId
 * @property int $expirationTimeId
 */
class CreatePasteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string,\Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'authorId' => 'numeric|nullable',
            'programmingLanguageId' => 'required|numeric',
            'accessRestrictionId' => 'required|numeric',
            'expirationTimeId' => 'numeric|nullable'
        ];
    }

}
