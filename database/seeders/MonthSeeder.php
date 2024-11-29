<?php

namespace Database\Seeders;

use App\Models\Food\Month;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $monthList = [
            'فروردین',
            'اردیبهشت',
            'خرداد',
            'تیر',
            'مرداد',
            'شهریور',
            'مهر',
            'آبان',
            'آذر',
            'دی',
            'بهمن',
            'اسفند',
        ];

        for($i = 1; $i < 13; $i++){
            $index = $i;
            Month::query()->create([
                'monthID' => $i,
                'monthName' => $monthList[--$index]
            ]);
        }
    }
}
