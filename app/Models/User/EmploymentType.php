<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentType extends Model
{
    use HasFactory;

    protected $table = 'employment_types';
//    protected $primaryKey = 'id';
    protected $primaryKey = 'employmentTypeID';

    protected $fillable = [];
}
