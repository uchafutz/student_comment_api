<?php

namespace App\Models\Lecture;

use App\Models\Department\Department;
use App\Models\Module\Module;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecture extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['lectureID', 'user_id', 'department_id', 'faculty_id'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $latest = Lecture::latest()->first();
            $phrase = "ID/" . rand(10090, 99009);
            // dd($latest);
            if (!$latest) {
                $model->lectureID = $phrase . '-' . 1;
            } else {
                $arr = explode("-", $latest->lectureID);
                $model->lectureID = $phrase . '-' . ($arr[1] + 1);
            }
        });
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'lecture_has_modules', 'lecture_id', 'module_id');
    }


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
