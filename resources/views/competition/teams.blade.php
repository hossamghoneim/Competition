@extends('layouts.app-without-sidebar')

@section('content')

    <section class="content">
        <div class="container-fluid">





            <div class="row">

                <div class="col-md-12">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Choosing team</h3>
                        </div>


                        <form method="POST" action="{{ route('competition.teams.select') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="team_id">Team</label>
                                        <select name="team_id" id="forTeams" class="form-control">
                                            <option value="" selected disabled>select your team</option>
                                            @foreach ($teams as $team)
                                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>


            </div>

        </div>

    </section>

@stop


