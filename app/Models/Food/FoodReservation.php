<?php

namespace App\Models\Food;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodReservation extends Model
{
    use HasFactory;

    protected $table = 'food_reservation';
    protected $primaryKey = 'reservID';

    protected $guarded = [];


    public function scopeIsMonthAllowedToBeEdited(Builder $query, int $givenMonth)
    {
        $current = verta()->month;
        $next = ++$current;

        if($givenMonth !== $current && $givenMonth !== $next){
            return $query;
        }

        $currentMonth = jalaliToGregorian(verta()->startMonth()->formatDate());
        $nextMonth = jalaliToGregorian(verta()->startMonth()->addMonth()->formatDate());

        return $query->whereIn('reservDate', [$currentMonth, $nextMonth])->doesntExist();

    }



    public function  scopeHasReservationsInMonth(Builder $query, string $startOfMonthInJalali, string $endOfMonthInJalali)
    {
        return $query->where('userID', auth()->user()->userID)
                ->whereBetween('reservDate', [
                        jalaliToGregorian($startOfMonthInJalali),
                        jalaliToGregorian($endOfMonthInJalali),
                ])
                ->exists();
    }


    public function  scopeHasFood(Builder $query, $foodID, string $startOfMonthInJalali, string $endOfMonthInJalali)
    {
        $isthereActiveReserves = $query->where('foodID', $foodID)
                ->whereBetween('reservDate', [
                        jalaliToGregorian($startOfMonthInJalali),
                        jalaliToGregorian($endOfMonthInJalali),
                ])
                ->exists();
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'foodID', 'foodID');
    }

}
