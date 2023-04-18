<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SpareQuestionAnswerStoreRequest;
use App\Models\SpareQuestion;
use App\Models\SpareQuestionAnswer;
use Illuminate\Http\Request;

class SpareQuestionAnswerController extends Controller
{

    public function index()
    {
        $spareQuestionAnswers = SpareQuestionAnswer::query()->with('spareQuestion')->paginate(10);

        return view('dashboard.spare-question-answers.index', compact('spareQuestionAnswers'));
    }


    public function create()
    {
        $spareQuestions = SpareQuestion::query()->get();

        $spareQuestionAnswer = SpareQuestionAnswer::get();

        if($spareQuestionAnswer)
        {
            if(count($spareQuestionAnswer) == 20)
            {
                return redirect()->route('spare-question-answers.index')->withErrors('Cannot add more than 20 spare questions answers');
            }
        }

        return view('dashboard.spare-question-answers.create', compact('spareQuestions'));
    }


    public function store(SpareQuestionAnswerStoreRequest $request)
    {
        $spareQuestion = SpareQuestion::withCount('spareQuestionAnswers')->find($request->spare_question_id);

        if($spareQuestion->spare_question_answers_count == 4)
        {
            return redirect()->route('spare-question-answers.create')->withErrors('Cannot add more than 4 answers to the same question');
        }

        SpareQuestionAnswer::create($request->validated());

        return redirect()->route('spare-question-answers.index')->withMessage('Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
