<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

/**
 * @property string $email
 * @property string $password
 */
class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'string|required',
            'password' => 'string|required'
        ];
    }

    /**
     *
     * @return array<string, string>
     * 
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Необходимо указать email',
            'email.string' => 'Поле email должен быть строкой',
            'password.required' => 'Необходимо указать password',
            'password.string' => 'Поле password должен быть строкой'
        ];
    }

    /**
     *
     * @param Validator $validator
     * 
     * @return JsonResponse
     * 
     */
    protected function failedValidation(Validator $validator): JsonResponse
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 400));
    }
}
