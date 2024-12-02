<?php

namespace App\Http\Requests\Auth;

use App\Models\User\PasswordResetToken;
use App\Models\User\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RecoveryPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules  = [];

        if ($this->routeIs('password.mobile')) {
            $rules['mobileNumber'] = ['required', Rule::in(User::all()->pluck('mobileNumber')->toArray())];

            if ($this->routeIs('verify-reset-code-store')) {
                $rules['code'] = ['required', Rule::in(PasswordResetToken::all()->pluck('token')->toArray())];
            }
        }

        if ($this->routeIs('login_two')) {
            $rules['mobileNumber'] = ['required', Rule::in(User::all()->pluck('mobileNumber')->toArray())];
        }

        if ($this->routeIs('login-with-mobile-store')) {
            $rules['code'] = ['required', Rule::in(PasswordResetToken::all()->pluck('token')->toArray())];
        }

        if ($this->routeIs('password.store')) {
            $rules['password'] = ['required', 'confirmed'];
        }

        return $rules;
    }


    public function attributes(): array
    {
        return [
            'code' => 'تاییدیه پیامکی',
            'mobileNumber' => 'شماره موبایل'
        ];
    }
}
