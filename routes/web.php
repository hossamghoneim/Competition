<?php

use App\Http\Controllers\Dashboard\AnswerController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\QuestionController;
use App\Http\Controllers\Dashboard\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::resource('teams', TeamController::class);
Route::resource('categories', CategoryController::class);
Route::resource('questions', QuestionController::class);
Route::resource('answers', AnswerController::class);

Route::get('competition', '\App\Http\Controllers\CompetitionController@competitionMainPage')->name('competition');
Route::get('competition/start', '\App\Http\Controllers\CompetitionController@startCompetition')->name('competition.start');
Route::get('competition/teams', '\App\Http\Controllers\CompetitionController@getTeams')->name('competition.teams');
Route::post('competition/teams/select', '\App\Http\Controllers\CompetitionController@selectTeam')->name('competition.teams.select');
Route::get('competition/categories/{team_id}', '\App\Http\Controllers\CompetitionController@getCategories')->name('competition.categories');
Route::post('competition/categories/select', '\App\Http\Controllers\CompetitionController@selectCategory')->name('competition.categories.select');
Route::get('competition/questions/{question}', '\App\Http\Controllers\CompetitionController@getAnswers')->name('competition.question');
Route::post('competition/answers/select', '\App\Http\Controllers\CompetitionController@selectAnswers')->name('competition.answers.select');
Route::post('competition/team/finish', '\App\Http\Controllers\CompetitionController@finish')->name('competition.team.finish');
Route::get('category-questions', '\App\Http\Controllers\CompetitionController@getQuestionsOfCategoriesAjax');
