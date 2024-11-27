<?php

namespace App\Models\Store;

use App\Models\Club\Club;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreDiscount extends Model
{
    use HasFactory;

    protected $table = 'store_discounts';


    protected $primaryKey = 'discountID';


    protected $guarded = [];


    public function club()
    {
        return $this->belongsTo(Club::class, 'clubID', 'userID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }


    public function scopeIsUserAllowedForThisStoreDiscountInCurrentMonth(Builder $query, int $storeID)
    {

        $verified = 'verified%';
        $waiting = 'waiting%';
        $currentMonth = jalaliToGregorian(verta()->startMonth()->formatDate());

        $query->where('userID', auth()->user()->userID)
              ->where('storeID', $storeID)
              ->where('discountDate', $currentMonth)
              ->where(function ($query) use ($verified, $waiting) {
                  $query->where('current_verification_state', 'like', "%{$verified}%")
                      ->orWhere('current_verification_state', 'like', "%{$waiting}%");
              })
              ->doesntExist();
    }

}
