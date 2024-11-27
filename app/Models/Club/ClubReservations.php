<?php

namespace App\Models\Club;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubReservations extends Model
{
    use HasFactory;

    protected $table = 'club_reservation';

    protected $primaryKey = 'reservID';

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function club()
    {
        return $this->belongsTo(Club::class, 'clubID', 'clubID');
    }


    public function scopeWhereUserHasReservationForDate(Builder $query, string $date)
    {
        $verification = 'rejected';
        $mother = 'مادر';
        $father = 'پدر';
        $relationshipsToExclude = [$mother, $father];
        return $this->query()
            ->where('userID', auth()->user()->userID)
            ->where('verification', '!=', $verification)
            ->where('reservDate', '=', $date)
            ->whereNotIn('secondayUserRelationship', $relationshipsToExclude);
    }


    public function scopeUserRelatedReservesForMonth(Builder $query, string $date)
    {
        $verification = 'rejected';
        return $this->query()
            ->where('userID', auth()->user()->userID)
            ->where('verification', '!=', $verification)
            ->where('reservDate', '=', $date)
            ->count();
    }
}
