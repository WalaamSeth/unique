<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:50',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'status' => 'required|string|max:20',
        ];

        return $rules;
    }
}
