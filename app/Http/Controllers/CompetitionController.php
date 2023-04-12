<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\QuestionResult;
use App\Models\Team;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function getTeams()
    {
        $teams = Team::query()->get();

        //for starting new competition between new 2 teams
        $countTeams = Team::whereNotNull('score')->count();
        if($countTeams == 2)
        {
            Team::whereNotNull('score')->get()->toQuery()->update([
                'score' => NULL
            ]);

            QuestionResult::whereNull('category_id')->delete();
        }

        return view('competition.teams', compact('teams'));
    }

    public function selectTeam(Request $request)
    {
        $team = Team::findOrFail($request->team_id);

        QuestionResult::create([
            'team_id' => $team->id,
        ]);

        return redirect()->route('competition')->withMessage('team selected successfully');
    }
    public function competitionMainPage()
    {
        return view('competition.main');
    }

    public function startCompetition()
    {
        if(QuestionResult::whereNull('category_id')->where('team_is_selected', TRUE)->where('team_is_finished', FALSE)->exists())
        {
            return redirect()->route('competition')->withErrors('There is a team in this competition');
        }

        $categories = Category::with('questions')->get();
        $questionResults = QuestionResult::query()->get();

        if(QuestionResult::whereNull('category_id')->where('team_is_finished', FALSE)->count() == 2)
        {
            $chosenTeam = $questionResults->random();
        }else{
            $chosenTeam = QuestionResult::whereNull('category_id')->where('team_is_finished', FALSE)->first();
        }


        QuestionResult::whereNull('team_is_selected')
            ->where('team_id', $chosenTeam->team_id)
            ->update([
                'team_is_selected' => TRUE
            ]);

        return redirect()->route('competition.categories', $chosenTeam->team_id)->withMessage('Competition started');
    }

    public function getCategories(Request $request)
    {
        $categories = Category::with('questions')->get();
        $team_id = $request->team_id;

        return view('competition.categories', compact('categories', 'team_id'));
    }

    public function selectCategory(Request $request)
    {
        $question = Question::find($request->question_id);
        $questionResult = QuestionResult::with('question')->where('team_is_selected', TRUE)->first();

        $questionResult->updateOrCreate([
            'category_id' => $request->category_id,
            'question_id' => $request->question_id,
            'question_is_selected' => TRUE
        ], [
            'team_id' => $questionResult->team_id,
            'question_id' => $request->question_id,
            'category_id' => $request->category_id,
            'question_is_selected' => TRUE,
            'team_is_selected' => TRUE
        ]);

        return redirect()->route('competition.question', $question)->withMessage('Question selected successfully');
    }

    public function getAnswers(Question $question)
    {
        return view('competition.answers', compact('question'));
    }

    public function selectAnswers(Request $request)
    {
        $answer = Answer::findOrFail($request->answer_id);
        $questionResult = QuestionResult::where('question_id', $answer->question_id)->first();
        $team = Team::find($questionResult->team_id);

        if($answer->is_correct)
        {
            $team->update([
                'score' => $team->score + 1
            ]);

            return redirect()->route('competition.categories', $team->id)->withMessage('you chose correct answer');
        }

        return redirect()->route('competition.categories', $team->id)->withErrors('you chose wrong answer');
    }

    public function finish()
    {
        $questionResult = QuestionResult::query()->where('team_is_selected', TRUE)
            ->whereNull('category_id')
            ->first();

        $questionResult->update([
            'team_is_finished' => TRUE,
        ]);

        //delete all old results for last team participated in competition
        QuestionResult::query()->where('team_is_selected', TRUE)
            ->whereNotNull('category_id')
            ->whereNotNull('question_id')
            ->delete();

        $countFinishedTeams = QuestionResult::where('team_is_finished', TRUE)
            ->where('team_is_selected', TRUE)
            ->count();

        if($countFinishedTeams == 2)
        {
            $questionResults = QuestionResult::with('team')->where('team_is_finished', TRUE)
                ->where('team_is_selected', TRUE)
                ->get();

            foreach ($questionResults as $questionResult)
            {
                $winnerTeam = $questionResult->team->selectWinnerTeam($questionResult->team_id, $questionResult->team->score);
                if($winnerTeam)
                {
                    return view('competition.show-the-winner', compact('winnerTeam'));
                }
            }


        }

        return redirect()->route('competition')->withMessage('Team has been finished');

    }

    public function getQuestionsOfCategoriesAjax(Request $request)
    {
        $category_id = $request->category_id;
        $team_id = $request->team_id;

        $questions = Question::query()->where('category_id', $category_id)
            ->with('category')
            ->whereDoesntHave('questionResults')
            ->get();

        $numberOfQuestions = QuestionResult::query()->whereNotNull('question_id')->count();

        return response()->json([
            'questions' => $questions,
            'numberOfQuestions' => $numberOfQuestions,
        ]);
    }
}
