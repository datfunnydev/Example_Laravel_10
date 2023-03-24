<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class MyProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'gender' => 'nullable|in:0,1',
            'phone' => 'nullable|string|max:12',
            'brith_day' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'brith_day' => $this->time_format($this->input('brith_day'), 'Y-m-d'),
        ]);
    }
}
