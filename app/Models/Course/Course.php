<?php

namespace App\Models\Course;

use App\Models\Department\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["name", "code", "credits", "department_id"];


    public function departments()
    {
        $this->belongsTo(Department::class, 'department_id');
    }
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $latest = Department::latest()->first();
            $phrase = "COURSE/" . rand(2000, 9009);
            // dd($latest);
            if (!$latest) {
                $model->code = $phrase . '-' . 1;
            } else {
                $arr = explode("-", $latest->code);
                $model->code = $phrase . '-' . ($arr[1] + 1);
            }
        });
    }
}
