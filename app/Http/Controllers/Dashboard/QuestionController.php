<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\QuestionStoreRequest;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(): Factory|View|Application
    {
        $questions = Question::query()->with('category')->paginate(10);

        return view('dashboard.questions.index', compact('questions'));
    }

    public function create()
    {
        $categories = Category::query()->get();

        $questions = Question::get();
        if($questions)
        {
            if(count($questions) == 20)
            {
                return redirect()->route('questions.index')->withErrors('Cannot add more than 20 questions');
            }
        }

        return view('dashboard.questions.create', compact('categories'));
    }

    public function store(QuestionStoreRequest $request)
    {
        $category = Category::withCount('questions')->find($request->category_id);
        if($category->questions_count == 4)
        {
            return redirect()->route('questions.create')->withErrors('Cannot add more than 4 questions to the same category');
        }

        Question::create($request->validated());

        return redirect()->route('questions.index')->withMessage('Created successfully');
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
