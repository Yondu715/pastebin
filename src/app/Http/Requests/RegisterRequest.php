<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $email
 * @property string $password
 * @property string $name
 */
class RegisterRequest extends FormRequest
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
            'name' => 'string|required',
            'email' => 'string|required|email',
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
            'name.required' => 'Необходимо указать name',
            'name.string' => 'Поле name должен быть строкой',
            'email.required' => 'Необходимо указать email',
            'email.string' => 'Поле email должен быть строкой',
            'email.email' => 'Поле email должно быть почтой',
            'password.required' => 'Необходимо указать password',
            'password.string' => 'Поле password должен быть строкой'
        ];
    }

}
