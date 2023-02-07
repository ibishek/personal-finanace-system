<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRegisterRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'min:2', 'max:20'],
            'last_name' => ['required', 'string', 'min:2', 'max:15'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', Password::min(8)->letters()->numbers()->mixedCase(), 'confirmed'],
            'password_confirmation' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'first_name.min' => 'The first name is too short.',
            'first_name.max' => 'The first name is too long.',
            'last_name.min' => 'The last name is too short.',
            'last_name.max' => 'The first name is too long.',
            'email.unique' => 'Email is already in use.'
        ];
    }
}
