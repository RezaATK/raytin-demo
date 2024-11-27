<?php

namespace App\Http\Requests\Users;

use App\Models\User\EmploymentType;
use App\Models\User\Unit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUsersRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'lastName' => ['required', 'max:255'],
            'mobileNumber' => ['required', 'max:255'],
            'password' => ['nullable', 'max:255'],
            'nationalCode' => ['required', 'max:20'],
            'employeeID' => ['required', 'max:20'],
            'unitID' => ['required', Rule::in(Unit::all()->pluck('unitID')->toArray())],
            'employmentTypeID' => ['required', Rule::in(EmploymentType::all()->pluck('employmentTypeID')->toArray())],
            'gender' => ['required', 'in:male,female'],
            'birthday' => ['required', 'date'],
        ];
    }


    public function attributes(): array
    {
        return [
            'lastName' => 'نام خانوادگی',
            'mobileNumber' => 'شماره موبایل',
            'nationalCode' => 'کد ملی',
            'employeeID' => 'شماره پرسنلی',
            'unitID' => 'واحد',
            'employmentTypeID' => 'نوع استخدام',
            'gender' => 'جنسیت',
            'birthday' => 'تاریخ تولد',
        ];
    }



}
