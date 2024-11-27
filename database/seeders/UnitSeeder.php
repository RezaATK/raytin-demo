<?php

namespace Database\Seeders;

use App\Models\User\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $units = ['فناوری اطلاعات',
            'امور مالی',
            'مدیریت فروش و بازاریابی',
            'روابط عمومی',
            'حراست',
            'معاونت بهره برداری',
            'HSE',
            'سیستم ها و استراتژی',
            'حوزه مدیرعامل',
            'برق و اتوماسیون صنعتی',
            'کنترل کیفیت و آزمایشگاه',
            'خرید',
            'انبارها و سفارشات',
            'خدمات عمومی و رفاهی',
            'برنامه ریزی تعمیرات و بازرسی فنی',
            'تاسیسات و پشتیبانی',
            'نامشخص',
        ];


        foreach ($units as $i => $unit){
            Unit::query()->create([
                'unitName' => $unit,
            ]);
        }
        foreach (Unit::all() as $i => $unit){
            $unit->update(['unitID' => $i]);
        }
    }
}
