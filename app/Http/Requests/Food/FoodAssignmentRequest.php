<?php

namespace App\Http\Requests\Food;

use App\Models\Food\Food;
use App\Models\Food\Month;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FoodAssignmentRequest extends FormRequest
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
            'foods' => ['nullable', 'array', Rule::in(Food::whereActive()->get()->modelKeys())]
        ];
    }
}
