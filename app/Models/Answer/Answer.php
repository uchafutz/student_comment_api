<?php

namespace App\Models\Answer;

use App\Models\Comment\Comment;
use App\Models\Question\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];

    public function question()
    {
        return $this->belongsToMany(Question::class, 'question_has_answers', 'answer_id', 'question_id');
    }
    public function commentItem()
    {
        return $this->hasMany(Comment::class);
    }
}
