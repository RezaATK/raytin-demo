<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /////////
        Permission::create([
            'name' => 'user:manage',
            'name_fa' => 'صفحه مدیریت کاربران',
            'guard_name' => 'web',
            'group_name' => 'مدیریت کاربران',
            'section_name' => 'بخش مدیریت کاربران',
        ]);

        Permission::create([
            'name' => 'user:create',
            'name_fa' => 'افزودن کاربر جدید',
            'guard_name' => 'web',
            'group_name' => 'مدیریت کاربران',
            'section_name' => 'بخش مدیریت کاربران',
        ]);

        Permission::create([
            'name' => 'user:edit',
            'name_fa' => 'ویرایش کاربران',
            'guard_name' => 'web',
            'group_name' => 'مدیریت کاربران',
            'section_name' => 'بخش مدیریت کاربران',
        ]);

        Permission::create([
            'name' => 'user:delete',
            'name_fa' => 'حذف کاربران',
            'guard_name' => 'web',
            'group_name' => 'مدیریت کاربران',
            'section_name' => 'بخش مدیریت کاربران',
        ]);

        Permission::create([
            'name' => 'user:export',
            'name_fa' => 'برون بری کاربران',
            'guard_name' => 'web',
            'group_name' => 'مدیریت کاربران',
            'section_name' => 'بخش مدیریت کاربران',
        ]);

        ######################################################################################

        Permission::create([
            'name' => 'usersfamilymembers:create',
            'name_fa' => 'افزودن عضو خانواده',
            'guard_name' => 'web',
            'group_name' => 'مدیریت اعضای خانواده کاربران',
            'section_name' => 'بخش مدیریت کاربران',
        ]);

        Permission::create([
            'name' => 'usersfamilymembers:edit',
            'name_fa' => 'ویرایش عضو خانواده',
            'guard_name' => 'web',
            'group_name' => 'مدیریت اعضای خانواده کاربران',
            'section_name' => 'بخش مدیریت کاربران',
        ]);

        Permission::create([
            'name' => 'usersfamilymembers:delete',
            'name_fa' => 'حذف عضو خانواده',
            'guard_name' => 'web',
            'group_name' => 'مدیریت اعضای خانواده کاربران',
            'section_name' => 'بخش مدیریت کاربران',
        ]);

        ######################################################################################
        ######################################################################################
        ######################################################################################

        Permission::create([
            'name' => 'clubcategory:manage',
            'name_fa' => 'صفحه مدیریت دسته بندی باشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت دسته بندی باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);
        Permission::create([
            'name' => 'clubcategory:create',
            'name_fa' => 'افزودن دسته بندی باشگاه',
            'guard_name' => 'web',
            'group_name' => 'مدیریت دسته بندی باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);
        Permission::create([
            'name' => 'clubcategory:edit',
            'name_fa' => 'ویرایش دسته بندی باشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت دسته بندی باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);
        Permission::create([
            'name' => 'clubcategory:delete',
            'name_fa' => 'حذف دسته بندی باشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت دسته بندی باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);
        Permission::create([
            'name' => 'clubcategory:export',
            'name_fa' => 'برون بری دسته بندی باشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت دسته بندی باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);

        ######################################################################################

        Permission::create([
            'name' => 'club:manage',
            'name_fa' => 'صفحه مدیریت باشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);

        Permission::create([
            'name' => 'club:create',
            'name_fa' => 'افزودن باشگاه',
            'guard_name' => 'web',
            'group_name' => 'مدیریت باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);

        Permission::create([
            'name' => 'club:edit',
            'name_fa' => 'ویرایش باشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);

        Permission::create([
            'name' => 'club:delete',
            'name_fa' => 'حذف باشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);

        Permission::create([
            'name' => 'club:export',
            'name_fa' => 'برون بری باشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);

        ######################################################################################

        Permission::create([
            'name' => 'clubreservation:manage',
            'name_fa' => 'صفحه کلی مدیریت رزرو باشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت رزرو باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);
        Permission::create([
            'name' => 'clubreservation:approve',
            'name_fa' => 'تایید رزرو باشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت رزرو باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);
        Permission::create([
            'name' => 'clubreservation:reject',
            'name_fa' => 'رد رزرو باشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت رزرو باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);
        Permission::create([
            'name' => 'clubreservation:stats',
            'name_fa' => 'صفحه آمار رزرو باشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت رزرو باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);
        Permission::create([
            'name' => 'clubreservation:allletters',
            'name_fa' => 'مشاهده تمام معرفی نامه های رزرو باشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت رزرو باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);

        Permission::create([
            'name' => 'clubreservation:delete',
            'name_fa' => 'حذف رزرو باشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت رزرو باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);

        Permission::create([
            'name' => 'clubreservation:export',
            'name_fa' => 'برون بری رزرو باشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت رزرو باشگاه ها',
            'section_name' => 'خدمات ورزشی',
        ]);

        ######################################################################################

        Permission::create([
            'name' => 'clubreserve:reserve',
            'name_fa' => 'امکان رزرو باشگاه',
            'guard_name' => 'web',
            'group_name' => 'رزرو باشگاه',
            'section_name' => 'خدمات ورزشی',
        ]);
        Permission::create([
            'name' => 'clubreserve:myreservations',
            'name_fa' => 'امکان مشاهده رزرو های خود',
            'guard_name' => 'web',
            'group_name' => 'رزرو باشگاه',
            'section_name' => 'خدمات ورزشی',
        ]);

        Permission::create([
            'name' => 'clubreserve:ownletter',
            'name_fa' => 'امکان مشاهده معرفی نامه رزرو های خود',
            'guard_name' => 'web',
            'group_name' => 'رزرو باشگاه',
            'section_name' => 'خدمات ورزشی',
        ]);
        

        ######################################################################################
        ######################################################################################
        ######################################################################################

        
        Permission::create([
            'name' => 'storecategory:manage',
            'name_fa' => 'صفحه مدیریت دسته بندی فروشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت دسته بندی فروشگاه ها',
            'section_name' => 'خدمات رفاهی',
        ]);
        Permission::create([
            'name' => 'storecategory:create',
            'name_fa' => 'افزودن دسته بندی فروشگاه',
            'guard_name' => 'web',
            'group_name' => 'مدیریت دسته بندی فروشگاه ها',
            'section_name' => 'خدمات رفاهی',
        ]);
        Permission::create([
            'name' => 'storecategory:edit',
            'name_fa' => 'ویرایش دسته بندی فروشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت دسته بندی فروشگاه ها',
            'section_name' => 'خدمات رفاهی',
        ]);
        Permission::create([
            'name' => 'storecategory:delete',
            'name_fa' => 'حذف دسته بندی فروشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت دسته بندی فروشگاه ها',
            'section_name' => 'خدمات رفاهی',
        ]);
        Permission::create([
            'name' => 'storecategory:export',
            'name_fa' => 'برون بری دسته بندی فروشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت دسته بندی فروشگاه ها',
            'section_name' => 'خدمات رفاهی',
        ]);

        ##############################################################################################

        Permission::create([
            'name' => 'store:manage',
            'name_fa' => 'صفحه مدیریت فروشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت فروشگاه ها',
            'section_name' => 'خدمات رفاهی',
        ]);

        Permission::create([
            'name' => 'store:create',
            'name_fa' => 'افزودن فروشگاه',
            'guard_name' => 'web',
            'group_name' => 'مدیریت فروشگاه ها',
            'section_name' => 'خدمات رفاهی',
        ]);

        Permission::create([
            'name' => 'store:edit',
            'name_fa' => 'ویرایش فروشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت فروشگاه ها',
            'section_name' => 'خدمات رفاهی',
        ]);

        Permission::create([
            'name' => 'store:delete',
            'name_fa' => 'حذف فروشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت فروشگاه ها',
            'section_name' => 'خدمات رفاهی',
        ]);
        Permission::create([
            'name' => 'store:export',
            'name_fa' => 'برون بری فروشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت فروشگاه ها',
            'section_name' => 'خدمات رفاهی',
        ]);

        ##############################################################################################

        Permission::create([
            'name' => 'alldiscounts:manage',
            'name_fa' => 'صفحه متصدی رفاهی',
            'guard_name' => 'web',
            'group_name' => 'متصدی رفاهی',
            'section_name' => 'خدمات رفاهی',
        ]);
        Permission::create([
            'name' => 'alldiscounts:approve',
            'name_fa' => 'تایید درخواست ها',
            'guard_name' => 'web',
            'group_name' => 'متصدی رفاهی',
            'section_name' => 'خدمات رفاهی',
        ]);
        Permission::create([
            'name' => 'alldiscounts:reject',
            'name_fa' => 'رد درخواست ها',
            'guard_name' => 'web',
            'group_name' => 'متصدی رفاهی',
            'section_name' => 'خدمات رفاهی',
        ]);
        Permission::create([
            'name' => 'alldiscounts:delete',
            'name_fa' => 'حذف درخواست ها',
            'guard_name' => 'web',
            'group_name' => 'متصدی رفاهی',
            'section_name' => 'خدمات رفاهی',
        ]);
        Permission::create([
            'name' => 'alldiscounts:export',
            'name_fa' => 'برون بری درخواست ها',
            'guard_name' => 'web',
            'group_name' => 'متصدی رفاهی',
            'section_name' => 'خدمات رفاهی',
        ]);

        ##############################################################################################

        Permission::create([
            'name' => 'verifydiscounts:manage',
            'name_fa' => 'صفحه متصدی حقوق و دستمزد',
            'guard_name' => 'web',
            'group_name' => 'متصدی حقوق و دستمزد',
            'section_name' => 'خدمات رفاهی',
        ]);
        Permission::create([
            'name' => 'verifydiscounts:approve',
            'name_fa' => 'تایید درخواست ها',
            'guard_name' => 'web',
            'group_name' => 'متصدی حقوق و دستمزد',
            'section_name' => 'خدمات رفاهی',
        ]);
        Permission::create([
            'name' => 'verifydiscounts:reject',
            'name_fa' => 'رد درخواست ها',
            'guard_name' => 'web',
            'group_name' => 'متصدی حقوق و دستمزد',
            'section_name' => 'خدمات رفاهی',
        ]);
        Permission::create([
            'name' => 'verifydiscounts:delete',
            'name_fa' => 'حذف درخواست ها',
            'guard_name' => 'web',
            'group_name' => 'متصدی حقوق و دستمزد',
            'section_name' => 'خدمات رفاهی',
        ]);
        Permission::create([
            'name' => 'verifydiscounts:additionalnote',
            'name_fa' => 'ثبت ملاحظات برای درخواست ها',
            'guard_name' => 'web',
            'group_name' => 'متصدی حقوق و دستمزد',
            'section_name' => 'خدمات رفاهی',
        ]);

        Permission::create([
            'name' => 'verifydiscounts:allletters',
            'name_fa' => 'مشاهده تمام معرفی نامه های فروشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'متصدی حقوق و دستمزد',
            'section_name' => 'خدمات رفاهی',
        ]);
        Permission::create([
            'name' => 'verifydiscounts:export',
            'name_fa' => 'برون بری درخواست ها',
            'guard_name' => 'web',
            'group_name' => 'متصدی حقوق و دستمزد',
            'section_name' => 'خدمات رفاهی',
        ]);


        ##############################################################################################
        Permission::create([
            'name' => 'storediscountsstats:stats',
            'name_fa' => 'صفحه آمار رزرو فروشگاه ها',
            'guard_name' => 'web',
            'group_name' => 'آمار درخواست ها',
            'section_name' => 'خدمات رفاهی',
        ]);

        ##############################################################################################

        Permission::create([
            'name' => 'storediscounts:request',
            'name_fa' => 'امکان رزرو فروشگاه',
            'guard_name' => 'web',
            'group_name' => 'درخواست خدمات رفاهی',
            'section_name' => 'خدمات رفاهی',
        ]);
        Permission::create([
            'name' => 'storediscounts:mydiscounts',
            'name_fa' => 'امکان مشاهده درخواست های خود',
            'guard_name' => 'web',
            'group_name' => 'درخواست خدمات رفاهی',
            'section_name' => 'خدمات رفاهی',
        ]);

        Permission::create([
            'name' => 'storediscounts:ownletter',
            'name_fa' => 'امکان مشاهده معرفی نامه درخواست های خود',
            'guard_name' => 'web',
            'group_name' => 'درخواست خدمات رفاهی',
            'section_name' => 'خدمات رفاهی',
        ]);


        ######################################################################################
        ######################################################################################
        ######################################################################################

        Permission::create([
            'name' => 'food:manage',
            'name_fa' => 'صفحه مدیریت غذا ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت غذا ها',
            'section_name' => 'رستوران',
        ]);

        Permission::create([
            'name' => 'food:create',
            'name_fa' => 'افزودن غذا',
            'guard_name' => 'web',
            'group_name' => 'مدیریت غذا ها',
            'section_name' => 'رستوران',
        ]);

        Permission::create([
            'name' => 'food:edit',
            'name_fa' => 'ویرایش غذا ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت غذا ها',
            'section_name' => 'رستوران',
        ]);

        Permission::create([
            'name' => 'food:delete',
            'name_fa' => 'حذف غذا ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت غذا ها',
            'section_name' => 'رستوران',
        ]);
        Permission::create([
            'name' => 'food:export',
            'name_fa' => 'برون بری غذا ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت غذا ها',
            'section_name' => 'رستوران',
        ]);

        ##############################################################################################
        Permission::create([
            'name' => 'foodassignment:manage',
            'name_fa' => 'صفحه مدیریت تخصیص غذا به ماه ها',
            'guard_name' => 'web',
            'group_name' => 'مدیریت تخصیص غذا به ماه ها',
            'section_name' => 'رستوران',
        ]);

        Permission::create([
            'name' => 'foodassignment:edit',
            'name_fa' => 'ویرایش منوی هر ماه',
            'guard_name' => 'web',
            'group_name' => 'مدیریت تخصیص غذا به ماه ها',
            'section_name' => 'رستوران',
        ]);

        ##############################################################################################
        Permission::create([
            'name' => 'foodstats:stats',
            'name_fa' => 'مشاهده صفحه آمار رزرو غذا ها',
            'guard_name' => 'web',
            'group_name' => 'آمار رزروها',
            'section_name' => 'رستوران',
        ]);
        ##############################################################################################
        Permission::create([
            'name' => 'foodreservation:reserve',
            'name_fa' => 'امکان رزرو غذا',
            'guard_name' => 'web',
            'group_name' => 'رزرو غذای ماهانه',
            'section_name' => 'رستوران',
        ]);
        Permission::create([
            'name' => 'foodreservation:myreservations',
            'name_fa' => 'امکان مشاهده رزروهای خود',
            'guard_name' => 'web',
            'group_name' => 'رزرو غذای ماهانه',
            'section_name' => 'رستوران',
        ]);
        ##############################################################################################
        ##############################################################################################
        
        
        
    }
}
