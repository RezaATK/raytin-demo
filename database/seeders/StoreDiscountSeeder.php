<?php

namespace Database\Seeders;

use App\Models\Store\Store;
use App\Models\Store\StoreDiscount;
use App\Models\User\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class StoreDiscountSeeder extends Seeder
{
    public function run($count): void
    {

        $users = User::all()->pluck('userID')->toArray();
        $stores = Store::all()->pluck('storeID')->toArray();
//        $stores = Store::all()->pluck('storeID')->toArray();

        for ($i = 0; $i < $count; $i++) {
            $userID = fake()->randomElement($users);
            $user = User::query()->find($userID);
            $storeID = fake()->randomElement($stores);
            $store = Store::query()->find($storeID);
            $bool = fake()->boolean();
            $data = [
                'userID' => $userID,
                'storeID' => $storeID,
                'storeName' => $store->storeName,
                'discountDate' => Carbon::now()->toDateString(),
                'UserName' => $user->name,
                'UserLastName' => $user->lastName,
                'UserNationalCode' => $user->nationalCode,
                'UserMobileNumber' => $user->mobileNumber,
                'UserEmployeeID' => $user->employeeID,
                'UserEmploymentTypeName' => $user->employmentType->employmentTypeName,
                'UserUnitName' => $user->unit->UnitName,
                'additionalNote' => fake()->name(),
                'verification_three' => null,
                'verified_at' => null,
                'trackingCode' => random_int(15135, 9999999999),
            ];
            if($bool){
                $data['verification_one'] = 'waiting';
                $data['verification_two'] = null;
                $data['current_verification_state'] = 'waiting_one';
            }else{
                $data['verification_one'] = 'verified';
                $data['verification_two'] = 'waiting';
                $data['current_verification_state'] = 'waiting_two';
            }
            StoreDiscount::query()->create($data);
        }

    }

}
