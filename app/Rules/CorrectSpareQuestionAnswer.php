<?php

namespace App\Rules;

use App\Models\SpareQuestion;
use App\Models\SpareQuestionAnswer;
use Illuminate\Contracts\Validation\Rule;

class CorrectSpareQuestionAnswer implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected int $spareQuestionID;
    protected SpareQuestion $spareQuestion;
    public function __construct(int $spareQuestionID)
    {
        $this->spareQuestionID = $spareQuestionID;
        $this->spareQuestion = SpareQuestion::find($spareQuestionID);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     */
    public function passes($attribute, $value)
    {
        if($value)
        {
            $spareQuestionAnswer = SpareQuestionAnswer::query()->where('spare_question_id', $this->spareQuestionID)
                ->where('is_correct', TRUE)
                ->first();

            if(!$spareQuestionAnswer)
                return TRUE;

            return NULL;
        }
        return TRUE;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Cannot add more than 1 correct answer';
    }

}
