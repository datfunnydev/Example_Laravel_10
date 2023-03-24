<?php

namespace App\Http\Requests\Admin\Update;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRoleRequest extends FormRequest
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
