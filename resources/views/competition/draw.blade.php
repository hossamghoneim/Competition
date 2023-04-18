@extends('layouts.app-without-sidebar')

@section('content')

    <section class="content">
        <div class="container-fluid">





            <div class="row">

                <div class="col-md-12">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Choosing spare questions</h3>
                        </div>


                        <form method="POST" action="{{ route('competition.answer.spare-questions') }}">
                            @csrf
                            @if($question)
                                <input type="hidden" name="question_id" value="{{ $question->id }}">

                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="question"><h3>{{$question->description}}?</h3></label>
                                            <select name="answer_id" id="forAnswers" class="form-control">
                                                <option value="" selected disabled>select your answer</option>
                                                @foreach ($question->spareQuestionAnswers as $answer)
                                                    <option value="{{ $answer->id }}">{{ $answer->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="col-md-12" id="teams_holder" style="display:none;">

                                            <label for="team_id">Choose a team </label>
                                            <select class="form-control" id="forTeams" name="team_id">
                                                <option value="" selected disabled>select the team that has been answered</option>
                                                @foreach ($teams as $team)
                                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            @else
                                <h3 style="text-align: center">Questions had been finished, please click submit to know the result</h3>
                            @endif

                            <div class="card-footer" id="submitButton">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>

                </div>


            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js"
                integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    </section>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.js"></script>
    <script type="text/javascript">
        $('#forAnswers').on('change', function() {
            $('#teams_holder').show();
        })
    </script>
@stop


