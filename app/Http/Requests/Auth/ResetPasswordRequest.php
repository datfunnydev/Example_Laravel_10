<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|max:255',
            'token' => 'required|string|max:255',
        ];
    }
}
