<?php

namespace Database\Seeders;

use App\Models\User\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name'  => config('auth.super_admin'),
            'guard_name' => 'web',
        ]);

        $user = User::where('mobileNumber', '=', '09160055185')->first();
        $user->assignRole(config('auth.super_admin'));
    }
}
