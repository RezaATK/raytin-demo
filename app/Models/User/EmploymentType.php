<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmploymentType extends Model
{
    use HasFactory
    // , SoftDeletes
    ;

    protected $table = 'employment_types';
//    protected $primaryKey = 'id';
    protected $primaryKey = 'employmentTypeID';

    protected $fillable = [];
}
