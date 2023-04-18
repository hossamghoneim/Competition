<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'score'];

    public function selectWinnerTeam($teamID, $teamScore)
    {
        $team = Team::whereNotNull('score')->where('id', '!=', $teamID)->first();

        if($team->score == $teamScore)
        {
            return FALSE;
        }

        if($team->score > $teamScore)
        {
            return $team;
        }

        return Team::where('id', $teamID)->first();
    }
}
