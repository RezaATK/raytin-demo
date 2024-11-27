<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';
//    protected $primaryKey = 'id';
    protected $primaryKey = 'unitID';

    protected $fillable = ['unitID', 'unitName'];
}
