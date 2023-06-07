<?php

namespace App\Models\Faculty;

use App\Models\Department\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function programme()
    {
        return $this->belongsToMany(Course::class, 'faculty_has_programme', 'faculty_id', 'course_id');
    }
}
