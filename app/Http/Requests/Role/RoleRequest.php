<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRequest extends FormRequest
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
        return [
            'name' => ['required', 'max:255', Rule::unique(Role::class)->ignore($this->route('role'))],
            'permissions' => ['required', 'array', Rule::in(Permission::all()->pluck('name')->toArray())],
        ];
    }

    public function attributes(): array
    {
        return [
            'permissions' => 'مجوز',
        ];
    }
}
