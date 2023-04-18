<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SpareQuestionStoreRequest;
use App\Models\SpareQuestion;
use Illuminate\Http\Request;

class SpareQuestionController extends Controller
{

    public function index()
    {
        $spareQuestions = SpareQuestion::paginate(10);

        return view('dashboard.spare-questions.index', compact('spareQuestions'));
    }

    public function create()
    {
        $spareQuestionsCount = SpareQuestion::query()->count();

        if($spareQuestionsCount == 5)
        {
            return redirect()->route('spare-questions.index')->withErrors('Cannot add more than 5 spare questions');
        }

        return view('dashboard.spare-questions.create');
    }


    public function store(SpareQuestionStoreRequest $request)
    {
        SpareQuestion::create($request->validated());

        return redirect()->route('spare-questions.index')->withMessage('Spare question created successfully');
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
