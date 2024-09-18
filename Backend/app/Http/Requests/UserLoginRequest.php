<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'remember' => ['nullable', 'boolean']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email field is required',
            'password.required' => 'Password field is required',
            'email.string' => 'Email should be string',
            'password.string' => 'Password should be string',
            'password.min' => 'Password should be at least 8 characters',
            'remember.boolean' => 'Remember should be boolean',
        ];
    }
}
