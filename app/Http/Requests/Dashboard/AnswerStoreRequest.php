<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\CorrectAnswerExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnswerStoreRequest extends FormRequest
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
            'description' => ['required', 'string', Rule::unique('answers')->where('question_id', $this->question_id)],
            'question_id' => 'required|integer|exists:questions,id',
            'is_correct'  => ['required', 'boolean', new CorrectAnswerExists($this->question_id)],
        ];
    }
}
