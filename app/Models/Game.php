<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'spare_question_id', 'team_id', 'category_id', 'your_turn'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function spareQuestion()
    {
        return $this->belongsTo(SpareQuestion::class, 'spare_question_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

}
