<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionResult extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'team_id', 'category_id', 'team_is_selected', 'team_is_finished', 'question_is_selected', 'answer_status'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
