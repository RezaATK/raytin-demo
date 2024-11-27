<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{

    protected $table = 'stores';
    protected $primaryKey = 'storeID';

    protected $fillable = [
                'storeName',
                'storeDetails',
                'storeTerms',
                'storeImage',
                'storeAddress',
                'storeNeighborhood',
                'storeCategoryID',
                'isActive',
    ];

    public function category()
    {
        return $this->belongsTo(StoreCategory::class, 'storeCategoryID', 'storeCategoryID');
    }
}
