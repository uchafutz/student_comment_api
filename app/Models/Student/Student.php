<?php

namespace App\Models\Student;

use App\Models\Course\Course;
use App\Models\Department\AccademicYear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["code", "user_id", "course_id", "accademic_year_id"];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $latest = Student::latest()->first();
            $phrase = "/" . date('y') . "/" . rand(100090, 990009);
            // dd($latest);
            if (!$latest) {
                $model->code = $phrase . '-' . 1;
            } else {
                $arr = explode("-", $latest->code);
                $model->code = $phrase . '-' . ($arr[1] + 1);
            }
        });
    }

    public function users()
    {
        return  $this->belongsTo(User::class, "user_id");
    }

    public function courses()
    {
        return $this->belongsTo(Course::class, "course_id");
    }

    public function accademics()
    {
        return $this->belongsTo(AccademicYear::class, "accademic_year_id");
    }
}
