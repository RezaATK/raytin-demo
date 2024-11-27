<?php

namespace App\Http\Requests\Club;

use App\Models\Club\Club;
use App\Models\Club\ClubCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClubRequest extends FormRequest
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
        $genders = ['آقایان و بانوان', 'بانوان', 'آقایان'];
        return [
            'clubCategoryID' => ['required', Rule::in(ClubCategory::pluck('clubCategoryID')->toArray())],
            'clubName' => ['required', 'max:255', Rule::unique(Club::class, 'clubName')->ignore($this->route('club'))],
            'clubDetails' => ['required', 'max:255'],
//            'clubImage' => ['nullable', 'max:255'],
            'clubAddress' => ['nullable', 'max:255'],
            'clubNeighborhood' => ['nullable', 'max:255'],
            'genderSpecific' => ['required', 'max:255', Rule::in($genders)],
        ];
    }


    public function attributes(): array
    {
        return [
            'clubCategoryID' => 'دسته بندی',
            'clubName' => 'نام باشگاه',
            'clubDetails' => 'توضیحات باشگاه',
//            'clubImage' => 'عکس باشگاه',
            'clubAddress' => 'آدرس باشگاه',
            'clubNeighborhood' => 'محله باشگاه',
            'genderSpecific' => 'جنسیت',
        ];
    }
}
