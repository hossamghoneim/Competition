<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TeamStoreRequest;
use App\Models\Team;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeamController extends Controller
{

    public function index(): Factory|View|Application
    {
        $teams = Team::query()->paginate(10);

        return view('dashboard.teams.index', compact('teams'));
    }

    public function create()
    {
        $teams = Team::get();
        if($teams)
        {
            if(count($teams) == 4)
            {
                return redirect()->route('teams.index')->withErrors('Cannot add more than 4 teams');
            }
        }
        return view('dashboard.teams.create');
    }


    public function store(TeamStoreRequest $request)
    {
        Team::create($request->validated());

        return redirect()->route('teams.index')->withMessage('Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
