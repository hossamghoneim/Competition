<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\CorrectSpareQuestionAnswer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpareQuestionAnswerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'description' => ['required', 'string', Rule::unique('spare_question_answers')->where('spare_question_id', $this->spare_question_id)],
            'spare_question_id' => 'required|integer|exists:spare_questions,id',
            'is_correct'  => ['required', 'boolean', new CorrectSpareQuestionAnswer($this->spare_question_id)],
        ];
    }

}
