<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AnswerStoreRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index(): Factory|View|Application
    {
        $answers = Answer::query()->with('question')->paginate(10);

        return view('dashboard.answers.index', compact('answers'));
    }

    public function create()
    {
        $questions = Question::query()->get();

        $answers = Answer::get();
        if($answers)
        {
            if(count($answers) == 80)
            {
                return redirect()->route('answers.index')->withErrors('Cannot add more than 80 answers');
            }
        }

        return view('dashboard.answers.create', compact('questions'));
    }

    public function store(AnswerStoreRequest $request)
    {
        $question = Question::withCount('answers')->find($request->question_id);
        if($question->answers_count == 4)
        {
            return redirect()->route('answers.create')->withErrors('Cannot add more than 4 answers to the same question');
        }

        Answer::create($request->validated());

        return redirect()->route('answers.index')->withMessage('Created successfully');
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
