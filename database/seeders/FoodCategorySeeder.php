<?php

namespace Database\Seeders;

use App\Models\Food\FoodCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryData = [
            'صبحانه',
            'ناهار',
            'شام',
        ];
        foreach($categoryData as $cat){
            FoodCategory::query()->create([
                'CategoryName' => $cat,
            ]);
        }
    }
}
