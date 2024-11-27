<?php

namespace App\Models\Food;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    use HasFactory;

    protected $table = 'foodcategory';
    protected $primaryKey = 'foodCategoryID';

    protected $guarded = [];

}
