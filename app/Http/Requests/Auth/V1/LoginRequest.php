<?php

namespace App\Http\Requests\Auth\V1;

use Anik\Form\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'email' => [
                'required',
                'exists:App\Models\User,email',
                'email'
            ],
            'password' => [
                'required',
                Password::min(8)->symbols(true)->mixedCase(true)
            ],
        ];
    }
}
