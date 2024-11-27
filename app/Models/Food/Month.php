<?php

namespace App\Models\Food;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory;

    protected $table = 'months';
    protected $primaryKey = 'monthID';

    protected $guarded = [];


    public function foods()
    {
        return $this->belongsToMany(Food::class,'months_foods_ids', 'monthID', 'foodID');
    }
}
