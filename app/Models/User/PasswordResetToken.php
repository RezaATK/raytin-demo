<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'uuid',
        'token',
        'mobileNumber'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
