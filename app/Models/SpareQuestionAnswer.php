<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpareQuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['spare_question_id', 'is_correct', 'description'];

    public function spareQuestion()
    {
        return $this->belongsTo(SpareQuestion::class, 'spare_question_id');
    }
}
