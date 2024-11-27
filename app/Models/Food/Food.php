<?php

namespace App\Models\Food;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';
    protected $primaryKey = 'foodID';

    protected $guarded = [];



    public function months()
    {
        return $this->belongsToMany(Month::class,'months_foods_ids', 'foodID', 'monthID');
    }

    public function category()
    {
        return $this->belongsTo(FoodCategory::class,'foodCategoryID', 'foodCategoryID');
    }


    public function scopeWhereActive($query)
    {
        return $query->where('isActive', '=', 1);
    }

}
