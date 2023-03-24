<?php

namespace App\Http\Requests\Admin\Create;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
