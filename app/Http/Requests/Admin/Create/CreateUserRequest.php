<?php

namespace App\Http\Requests\Admin\Create;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'gender' => 'nullable|in:0,1',
            'phone' => 'nullable|string|max:12',
            'brith_day' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',

            'role_id' => 'required',
        ];
    }
}
