<?php

namespace App\Http\Requests\Food;

use App\Models\Food\Food;
use App\Models\Food\FoodCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FoodRequest extends FormRequest
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
            'foodCategoryID' => ['required', Rule::in(FoodCategory::pluck('foodCategoryID')->toArray())],
            'foodName' => ['required', 'max:255', Rule::unique(Food::class, 'foodName')->ignore($this->route('food'))],
            'foodDetails' => ['required', 'max:500'],
            'foodImage' => ['nullable', 'max:255'],
            'foodPrice' => ['required', 'integer', 'max_digits:10'],
            'isActive' => ['nullable', 'in:1,0'],
        ];
    }


    public function attributes(): array
    {
        return [
            'foodCategoryID' => 'دسته بندی',
            'foodName' => 'نام فروشگاه',
            'foodDetails' => 'توضیحات فروشگاه',
            'foodImage' => 'عکس فروشگاه',
            'foodPrice' => 'هزینه',
            'isActive' => 'وضعیت',
        ];
    }

    public function prePareForValidation(): void
    {
        $this->merge([
            'foodImage' => '',
            'foodPrice' => $this->has('foodPrice') ? $this->removeCommas($this->input('foodPrice')) : null,
        ]);
    }

    private function removeCommas($intWithcommas)
    {
        return str_replace(',', '', $intWithcommas);
    }
}
