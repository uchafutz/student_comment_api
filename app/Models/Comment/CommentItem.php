<?php

namespace App\Models\Comment;

use App\Models\Question\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['comment_id', 'question_id', 'answer_id'];

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }


    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }
}
