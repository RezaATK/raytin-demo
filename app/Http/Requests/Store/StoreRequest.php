<?php

namespace App\Http\Requests\Store;

use App\Models\Store\Store;
use App\Models\Store\StoreCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'storeCategoryID' => ['required', Rule::in(StoreCategory::pluck('storeCategoryID')->toArray())],
            'storeName' => ['required', 'max:255', Rule::unique(Store::class, 'storeName')->ignore($this->route('store'))],
            'file' => ['nullable', 'image', 'max:2048', "mimes:jpg,jpeg", "extensions:jpg,jpeg"],
            'storeTerms' => ['required', 'max:255'],
            'storeDetails' => ['nullable', 'max:255'],
            'storeAddress' => ['nullable', 'max:255'],
            'storeNeighborhood' => ['nullable', 'max:255'],
            'isActive' => ['nullable', 'in:1,0' ,'max:255'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'isActive' => $this->has('isActive') ? 1 : 0,
        ]);
    }

    public function attributes(): array
    {
        return [
            'storeCategoryID' => 'دسته بندی',
            'storeName' => 'نام باشگاه',
            'storeTerms' => 'شرایط فروشگاه',
            'file' => 'عکس فروشگاه',
            'storeDetails' => 'توضیحات فروشگاه',
            'storeAddress' => 'آدرس فروشگاه',
            'storeNeighborhood' => 'محله فروشگاه',
            'isActive' => 'وضعیت',
        ];
    }
}
