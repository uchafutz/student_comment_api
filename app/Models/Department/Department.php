<?php

namespace App\Models\Department;

use App\Models\Course\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'code', 'description'];
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $latest = Department::latest()->first();
            $phrase = "DEPART/000";
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
