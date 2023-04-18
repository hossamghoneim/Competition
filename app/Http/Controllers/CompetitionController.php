<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Game;
use App\Models\Question;
use App\Models\SpareQuestion;
use App\Models\SpareQuestionAnswer;
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

            Game::query()->truncate();
        }

        return view('competition.teams', compact('teams'));
    }

    public function selectTeam(Request $request)
    {
        if(count($request->teams_ids) != 2)
        {
            return redirect()->route('competition.teams')->withErrors('You must choose only 2 teams');
        }

        foreach($request->teams_ids as $teamID)
        {
            Game::create([
                'team_id' => $teamID
            ]);
        }

        return redirect()->route('competition')->withMessage('teams selected successfully');
    }
    public function competitionMainPage()
    {
        return view('competition.main');
    }

    public function startCompetition()
    {
        $games = Game::query()->get();

        if(count($games) != 2)
        {
            return redirect()->route('competition.teams')->withErrors('Select teams to start');
        }

        $chosenTeam = $games->random();


        Game::query()->where('team_id', $chosenTeam->team_id)->update([
            'your_turn' => TRUE
        ]);

        return redirect()->route('competition.categories', $chosenTeam->team_id)->withMessage('Team ' . $chosenTeam->team->name . ' must play');
    }

    public function getCategories(Request $request)
    {
        $categories = Category::with('questions')->get();
        $team_id = $request->team_id;

        return view('competition.categories', compact('categories', 'team_id'));
    }

    public function selectCategory(Request $request)
    {
        if(!$request->category_id)
        {
            return redirect()->route('competition.categories', $request->team_id)->withErrors('You must select category');
        }

        if(!$request->question_id)
        {
            return redirect()->route('competition.categories', $request->team_id)->withErrors('You must select question');
        }

        $question = Question::find($request->question_id);
        $game = Game::with('question')->where('your_turn', TRUE)->first();

        $game->updateOrCreate([
            'category_id' => $request->category_id,
            'question_id' => $request->question_id,
            'your_turn' => TRUE
        ], [
            'team_id' => $game->team_id,
            'question_id' => $request->question_id,
            'category_id' => $request->category_id,
            'your_turn' => TRUE,
        ]);

        return redirect()->route('competition.question', $question)->withMessage('Question selected successfully');
    }

    public function getAnswers(Question $question)
    {
        return view('competition.answers', compact('question'));
    }

    public function selectAnswers(Request $request)
    {
        if(!$request->answer_id)
        {
            return redirect()->route('competition.question', Question::find($request->question_id))->withErrors('You must select answer');
        }

        $answer = Answer::findOrFail($request->answer_id);
        $game = Game::where('question_id', $answer->question_id)->first();
        $team = Team::find($game->team_id);

        if($answer->is_correct)
        {
            $team->update([
                'score' => $team->score + 1
            ]);

            //Switch OFF Latest Team Has The Turn To Play
            $lastGame = Game::query()->where('team_id', $team->id)->first();
            $lastGame->update([
                'your_turn' => FALSE
            ]);

            //Switch ON The Team That Must Play
            $game = Game::query()->with('team')->where('team_id', '!=', $team->id)->first();
            $game->update([
                'your_turn' => TRUE
            ]);
            return redirect()->route('competition.categories', $team->id)->withMessage('You chose correct answer. Team '. $game->team->name . ' has the turn to play');
        }

        //Switch OFF Latest Team Has The Turn To Play
        $lastGame = Game::query()->where('team_id', $team->id)->first();
        $lastGame->update([
            'your_turn' => FALSE
        ]);

        //Switch ON The Team That Must Play
        $game = Game::query()->with('team')->where('team_id', '!=', $team->id)->first();
        $game->update([
            'your_turn' => TRUE
        ]);
        return redirect()->route('competition.categories', $team->id)->withErrors('You chose wrong answer. Team '. $game->team->name . ' has the turn to play');
    }

    public function finish()
    {
        $games = Game::with('team')->whereNull('question_id')->get();

        foreach ($games as $game)
        {
            $winnerTeam = $game->team->selectWinnerTeam($game->team_id, $game->team->score);

            if($winnerTeam)
            {
                return view('competition.show-the-winner', compact('winnerTeam'));
            }else{
                return redirect()->route('competition.draw')->withErrors('Draw between the 2 teams');
            }
        }

        return redirect()->route('competition.teams')->withErrors('Draw between the 2 teams');
    }

    public function getSpareQuestions()
    {
        $teams = Team::whereNotNull('score')->get();
        $question = SpareQuestion::query()->with('spareQuestionAnswers')->whereDoesntHave('games')->first();

        return view('competition.draw', compact('teams', 'question'));
    }

    public function answerSpareQuestions(Request $request)
    {
        $gamesCount = Game::query()->whereNotNull('spare_question_id')->count();

        if ($gamesCount == 5)
        {
            $games = Game::with('team')->whereNull('spare_question_id')->get();

            foreach ($games as $game)
            {
                $winnerTeam = $game->team->selectWinnerTeam($game->team_id, $game->team->score);

                if($winnerTeam)
                {
                    return view('competition.show-the-winner', compact('winnerTeam'));
                }else{
                    return view('competition.draw-again');
                }
            }
        }

        if(!$request->answer_id)
        {
            return redirect()->route('competition.draw')->withErrors('You must select an answer');
        }

        if(!$request->team_id)
        {
            return redirect()->route('competition.draw')->withErrors('You must select the team that had been answered');
        }

        $team = Team::find($request->team_id);
        $answer = SpareQuestionAnswer::find($request->answer_id);

        Game::create([
            'team_id' => $request->team_id,
            'spare_question_id' => $request->question_id,
        ]);

        if($answer->is_correct)
        {
            $team->update([
                'score' => $team->score + 1
            ]);

            return redirect()->route('competition.draw')->withMessage($team->name . ' Answered correctly');
        }

        return redirect()->route('competition.draw')->withErrors($team->name . ' Answered incorrectly');
    }

    public function getQuestionsOfCategoriesAjax(Request $request)
    {
        $category_id = $request->category_id;

        $questions = Question::query()->where('category_id', $category_id)
            ->with('category')
            ->whereDoesntHave('games')
            ->get();

        $numberOfQuestions = game::query()->whereNotNull('question_id')->count();

        return response()->json([
            'questions' => $questions,
            'numberOfQuestions' => $numberOfQuestions,
        ]);
    }
}
