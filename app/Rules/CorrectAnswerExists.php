<?php

namespace App\Rules;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Contracts\Validation\Rule;

class CorrectAnswerExists implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected int $questionID;
    protected Question $question;
    public function __construct(int $questionID)
    {
        $this->questionID = $questionID;
        $this->question = Question::find($questionID);
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
            $answer = Answer::query()->where('question_id', $this->questionID)->where('is_correct', TRUE)->first();

            if(!$answer)
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
