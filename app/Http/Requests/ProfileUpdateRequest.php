<?php

namespace App\Http\Requests;

use App\Models\User\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required', 'current_password', 'max:255'],
            'password' => ['required', Password::min(8), 'max:200', 'confirmed'],
        ];
    }


    public function attributes()
    {
        return [
            'current_password' => 'کلمه عبور کنونی',
            'password' => 'کلمه عبور جدید',
            'password_confirmation' => 'تکرار کلمه عبور جدید',
        ];
    }
}
