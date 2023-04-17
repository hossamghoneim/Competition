@extends('layouts.app-without-sidebar')

@section('content')

    <section class="content">
        <div class="container-fluid">





            <div class="row">

                <div class="col-md-12">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Choosing your answer</h3>
                        </div>


                        <form method="POST" action="{{ route('competition.answers.select') }}">
                            @csrf
                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="question"><h3>{{$question->description}}?</h3></label>
                                        <select name="answer_id" id="forAnswers" class="form-control">
                                            <option value="" selected disabled>select your answer</option>
                                            @foreach ($question->answers as $answer)
                                                <option value="{{ $answer->id }}">{{ $answer->description }}</option>
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


