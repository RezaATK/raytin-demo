<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersFamilymembersIds extends Model
{
    use HasFactory;

    protected $table = 'users_familymembers_ids';

    protected $guarded = [];

//    protected $primaryKey = 'id';
    protected $primaryKey = 'FamilyID';
}
