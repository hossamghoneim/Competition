
@extends('layouts.app')
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.1/echarts.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Spare question answers</h3>
                        </div>


                        <form method="POST" action="{{route('spare-question-answers.store')}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputDescription1">Description</label>
                                    <input type="text" class="form-control" name="description" id="exampleInputDescription1" placeholder="Enter description">
                                </div>

                                <div class="form-group">
                                    <label>Spare questions</label>
                                    <select class="form-control" name="spare_question_id">
                                        <option selected disabled>select spare question</option>
                                        @foreach($spareQuestions as $spareQuestion)
                                            <option value="{{ $spareQuestion->id }}">{{ $spareQuestion->description }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Correct answer</label>
                                    <select class="form-control" name="is_correct">
                                        <option selected disabled>select it is a correct answer or not</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
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
@endsection
@section('javascript')

@endsection



