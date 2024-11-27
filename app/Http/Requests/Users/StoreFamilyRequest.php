<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreFamilyRequest extends FormRequest
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
        $relationshipList = [
            0 => 'همسر',
            1 => 'فرزند',
            2 => 'پدر',
            3 => 'مادر',
            4 => 'خواهر',
            5 => 'برادر',
        ];
        $relationshipList = implode(',', $relationshipList);
        return [
            'familyMemberName' => ['required', 'max:255'],
            'employeeID' => ['nullable', 'max:255'],
            'familyMemberLastName' => ['required', 'max:255'],
            'familyMemberNationalCode' => ['required', 'max:20'],
            'familyMemberMobileNumber' => ['nullable', 'max:255'],
            'familyMemberBirthday' => ['required', 'max:20'],
            'familyMemberGender' => ['required', 'max:20'],
            'familyMemberRelationship' => ['required', "in:{$relationshipList}"],
        ];
    }


    public function prepareForValidation()
    {
        $this->merge([
            'familyMemberBirthday' => jalaliToGregorian($this->input('familyMemberBirthday')) ?? null,
        ]);
    }
    public function attributes(): array
    {
        return [
            'familyMemberName' => 'نام',
            'familyMemberLastName' => 'نام خانوادگی',
            'familyMemberMobileNumber' => 'شماره موبایل',
            'familyMemberNationalCode' => 'کد ملی',
            'familyMemberGender' => 'جنسیت',
            'familyMemberBirthday' => 'تاریخ تولد',
            'familyMemberRelationship' => 'نسبت',
        ];
    }



}
