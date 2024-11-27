<?php

namespace Database\Seeders;

use App\Models\Club\ClubCategory;
use Illuminate\Database\Seeder;

class ClubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clubcategoryies=  [1 => 'بدنسازی',
                            2 => 'فوتبال',
                            11 => 'پینک-پونگ',
                            12 => 'والیبال',
                            14 => 'بسکتبال',
                            16 => 'کشتی',
        ];

        foreach($clubcategoryies as $i => $cat){
            $c = ClubCategory::query()->create([
                'categoryName' => $cat
            ]);
            $c->update(['clubCategoryID' => $i]);
        }
    }
}
