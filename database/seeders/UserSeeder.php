<?php

namespace Database\Seeders;

use App\Models\User\EmploymentType;
use App\Models\User\Unit;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($count): void
    {
        $units = Unit::all()->pluck('unitID')->toArray();
        $employmentTypes = EmploymentType::all()->pluck('employmentTypeID')->toArray();
        $password = Hash::make('password');
        User::query()->create([
            'name' => 'Admin User',
            'lastName' => 'atefi',
            'mobileNumber' => '09160055185',
            'password' => Hash::make('password'),
//            'email' => 'admin@example.com',
            'employeeID' => 600,
            'unitID' => 2,
            'employmentTypeID' => 2,
            'birthday' => '1993-10-10',
            'gender' => 'male',
            'isActive' => 1,
            'role_id' => 0,
            'nationalCode' => 1234567,
        ]);
        for($i = 0; $i < $count; $i++){
            User::insert([
                'name' => fake()->name,
                'lastName' => fake()->name,
                'mobileNumber' => '09' . random_int(132314512,999999999),
//            'email' => 'admin@example.com',
                'password' => fake()->randomElement([$password, null]),
                'employeeID' => random_int(1323145,8786441),
                'unitID' => fake()->randomElement($units),
                'employmentTypeID' => fake()->randomElement($employmentTypes),
                'birthday' => '2024-10-10',
                'gender' => 'male',
                'isActive' => fake()->boolean(),
                'role_id' => 0,
                'nationalCode' => random_int(1323145,8786441),
            ]);
        }
    }
}
