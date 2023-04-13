<?php

namespace App\Http\Controllers;

use App\Models\Team;

class HomeController extends Controller
{
    public function index()
    {
        $teams = Team::query()->paginate(10);

        return view('dashboard.teams.index', compact('teams'));
    }


}
