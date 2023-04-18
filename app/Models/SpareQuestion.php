<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpareQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['description'];

    public function games()
    {
        return $this->hasMany(Game::class, 'spare_question_id');
    }

    public function spareQuestionAnswers()
    {
        return $this->hasMany(SpareQuestionAnswer::class, 'spare_question_id');
    }
}
