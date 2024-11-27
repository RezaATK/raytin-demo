<?php

namespace App\Http\Requests\Food;

use App\Models\Food\Food;
use App\Models\Food\FoodCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FoodReservationRequest extends FormRequest
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
            'data' => ['required', 'array'],
            'month' => ['required'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'month' => $this->checkForMonth(),
        ]);
    }


    public function checkForMonth(): ?int
    {
        if($this->has('currentMonthSubmit')) {
            return verta()->month;
        }
        if($this->has('nextMonthSubmit')) {
            return verta()->addMonth()->month;
        }

        return null;
    }

}
