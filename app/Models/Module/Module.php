<?php

namespace App\Models\Module;

use App\Models\Department\AccademicYear;
use App\Models\Lecture\Lecture;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'code', 'accademic_year_id', 'credit'];

    public function accademics()
    {
        return $this->belongsTo(AccademicYear::class, 'accademic_year_id');
    }

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class, 'lecture_has_module', 'module_id', 'lecture_id');
    }
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $latest = Module::latest()->first();
            $phrase = date('Y') . "/" . rand(5000, 9909);
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
