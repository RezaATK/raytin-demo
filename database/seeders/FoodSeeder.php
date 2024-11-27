<?php

namespace Database\Seeders;

use App\Models\Food\Food;
use App\Models\Food\FoodCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($count): void
    {
        $categories = FoodCategory::query()->get()->modelKeys();
        for($i = 0; $i < $count; $i++) {
            Food::query()->create([
                'foodName' => fake()->unique()->userName(),
                'foodDetails' => fake()->text(50),
                'foodImage' => fake()->unique()->imageUrl(300, 300),
                'foodPrice' => fake()->numberBetween(100_000, 600_000),
                'foodCategoryID' => fake()->randomElement($categories),
                'isActive' => fake()->boolean(),
            ]);
        }
    }
}
