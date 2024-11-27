<?php

namespace App\Models\Club;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubCategory extends Model
{
    use HasFactory;

    protected $table = 'clubcategory';
    protected $primaryKey = 'clubCategoryID';

    protected $guarded = [];
}
