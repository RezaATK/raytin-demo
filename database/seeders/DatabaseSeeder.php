<?php

namespace Database\Seeders;

use App\Models\User\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(UnitSeeder::class);
        $this->call(EmploymentTypeSeeder::class);
        
//
//        User::factory()->create(
//              [
//            'name' => 'Admin User',
//            'lastName' => 'atefi',
//            'mobileNumber' => '09160055185',
////            'email' => 'admin@example.com',
//            'password' => Hash::make('password'),
//            'employeeID' => 600,
//            'unitID' => 2,
//            'employmentTypeID' => 2,
//            'birthday' => '2024-10-10',
//            'gender' => 'male',
//            'isActive' => 1,
//            'role_id' => 0,
//            'nationalCode' => 1234567,
//        ]);

       $this->call(UserSeeder::class, parameters: ['count' => 50]);
       $this->call(ClubCategorySeeder::class);
       $this->call(ClubSeeder::class, parameters: ['count' => 50]);
    //    $this->call(ClubReservationsSeeder::class, parameters: ['count' => 50]);
//        $this->call(StoreDiscountSeeder::class, parameters: ['count' => 100_000]);

        $this->call(PermissionSeeeder::class);
       $this->call(RoleSeeder::class);
//        $this->call(FoodCategorySeeder::class);
        // $this->call(FoodSeeder::class, parameters: ['count' => 10]);
    }
}
