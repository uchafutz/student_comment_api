<?php

namespace App\Models\Department;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccademicYear extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['accademic_year', 'status'];
}
