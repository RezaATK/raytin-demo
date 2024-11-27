<?php

namespace Database\Seeders;

use App\Models\Club\Club;
use App\Models\Club\ClubCategory;
use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($count): void
    {

        $clubcategoryIds = ClubCategory::all()->pluck('clubCategoryID')->toArray();
        for ($i = 0; $i < $count; $i++) {
            Club::create([
            'clubCategoryID' => fake()->randomElement($clubcategoryIds),
            'clubName' => fake()->name,
            'clubDetails' => fake()->address(),
            'clubImage' => '',
            'clubAddress' => fake()->address(),
            'clubNeighborhood' => null,
            'genderSpecific' => fake()->randomElement(['آقایان و بانوان', 'بانوان', 'آقایان']),
            'isActive' => 1,

        ]);
        }

    }
}
