<?php

namespace App\Models\Question;

use App\Models\Answer\Answer;
use App\Models\Comment\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use  SoftDeletes;

    protected $fillable = ['name'];

    public function answer()
    {
        return $this->belongsToMany(Answer::class, 'question_has_answers', 'question_id', 'answer_id');
    }

    public function commentItem()
    {
        return $this->hasMany(Comment::class);
    }
}
