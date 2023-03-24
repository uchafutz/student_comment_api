<?php

namespace App\Models\Comment;

use App\Models\Lecture\Lecture;
use App\Models\Module\Module;
use App\Models\Student\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'rates', 'lecture_id', 'module_id', 'student_id'];

    public function lectures()
    {
        return $this->belongsTo(Lecture::class, "lecture_id");
    }

    public function modules()
    {
        return $this->belongsTo(Module::class, "module_id");
    }

    public function students()
    {
        return $this->belongsTo(Student::class, "student_id");
    }

    public function item()
    {
        return $this->hasMany(CommentItem::class);
    }
}
