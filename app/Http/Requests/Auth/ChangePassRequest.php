<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'old_password' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ];
    }
}
