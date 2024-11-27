<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Club\ClubReservations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
//    protected $fillable = [
//        'name',
//        'email',
//        'password',
//    ];

    protected $table = 'users';
//    protected $primaryKey = 'id';
    protected $primaryKey = 'userID';

    protected $guarded = [];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    public function family(): HasMany
    {
        return $this->hasMany(UsersFamilymembersIds::class, 'userID', 'userID');
    }

    public function clubReservations(): HasMany
    {
        return $this->hasMany(ClubReservations::class, 'userID', 'userID');
    }


    public function scopeUserFamilyCount(Builder $query): int
    {
        return $query->withCount('family')->findOrFail(auth()->user()->userID)->family_count;
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unitID', 'unitID');
    }

    public function employmentType()
    {
        return $this->belongsTo(EmploymentType::class, 'employmentTypeID', 'employmentTypeID');
    }
}
