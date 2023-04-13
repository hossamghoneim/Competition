@extends('layouts.app-without-sidebar')

@section('content')

    <section class="content">
        <div class="container-fluid">





            <div class="row">

                <div class="col-md-12">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Choosing category</h3>
                        </div>


                        <form method="POST" action="{{ route('competition.categories.select') }}">
                            @csrf
                            <input type="hidden" name="team_id" value="{{ $team_id }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" id="forCategories" class="form-control">
                                            <option value="" selected disabled>select your category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12" id="questions_holder" style="display:none;">

                                        <label for="question_id">Choose a question </label>
                                        <select class="form-control" id="forQuestions" name="question_id">

                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="card-footer" id="submitButton">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        <form method="POST" id="finish_form" action="{{ route('competition.team.finish') }}" style="display:none;">
                            @csrf
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Finish</button>
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
        var category_id;
        var question;
        var all_questions_length = 0;
        $('#forCategories').on('change', function() {
            category_id = this.value;
            console.log(category_id);
            $.ajax({
                type: 'get',
                url: '{{ URL::to('category-questions') }}',
                data:{'category_id':category_id},
                dataType:'json',
                success:function(data){
                    console.log(data);

                    if(data.numberOfQuestions == 20)
                    {
                        $('#finish_form').show();
                        $('#submitButton').hide();
                    }

                    $('#questions_holder').show();
                    $('#forQuestions').empty();
                    $('#forQuestions').append(`<option disabled selected='selected'>select your question</option>`)
                    console.log(data.questions.length, data.questions);
                    data['questions'].forEach(question => {
                        $('#forQuestions').append(`<option value='${question.id}'> ${question.description} </option>`)
                    });
                }
            })
        })
        $('#forQuestions').on('change', function() {
            question = this.value;
        })
    </script>
@stop


