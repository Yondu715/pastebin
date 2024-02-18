<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $email
 * @property string $password
 * @property bool $remember
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
            'email' => 'string|required|email|unique:users,email',
            'password' => 'string|required|max:255',
            'remember' => 'bool'
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
            'email.email' => 'Поле email должно быть почтой',
            'password.required' => 'Необходимо указать password',
            'password.string' => 'Поле password должен быть строкой'
        ];
    }

}
