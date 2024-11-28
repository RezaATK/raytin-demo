<?php

namespace App\Models\Club;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Club extends Model
{
    use HasFactory;

    protected $table = 'clubs';
    protected $primaryKey = 'clubID';

    protected $fillable = [
                'clubCategoryID',
                'clubName',
                'clubDetails',
                'clubImage',
                'clubAddress',
                'clubNeighborhood',
                'genderSpecific',
                'isActive',
    ];


    public function category()
    {
        return $this->belongsTo(ClubCategory::class, 'clubCategoryID', 'clubCategoryID');
    }



    public function clubReservations(): HasMany
    {
        return $this->hasMany(ClubReservations::class, 'clubID', 'clubID');
    }
}
