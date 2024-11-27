<?php

namespace Database\Seeders;

use App\Models\User\EmploymentType;
use Illuminate\Database\Seeder;

class EmploymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['اکسین',
            'اکسین صنعت یاران جنوب 1',
            'اکسین صنعت یاران جنوب 2',
            'نامشخص',
            ];


        foreach ($types as $i => $type){
            EmploymentType::query()->create([
                'employmentTypeName' => $type,
            ]);
        }

        foreach(EmploymentType::all() as $i => $type){
            $type->update([
                'employmentTypeID' => $i
            ]);
        }
    }
}
