<?php

namespace App\Http\Requests\Store;

use App\Models\Store\StoreCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
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
            'categoryName' => ['required', 'max:255', Rule::unique(StoreCategory::class,'categoryName')->ignore($this->route('storeCategory'))],
        ];
    }


    public function attributes(): array
    {
        return [
            'categoryName' => 'نام دسته بندی',
        ];
    }
}
