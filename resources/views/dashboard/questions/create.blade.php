
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
                            <h3 class="card-title">Questions</h3>
                        </div>


                        <form method="POST" action="{{route('questions.store')}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputDescription1">Description</label>
                                    <input type="text" class="form-control" name="description" id="exampleInputDescription1" placeholder="Enter description">
                                </div>

                                <div class="form-group">
                                    <label>Categories</label>
                                    <select class="form-control" name="category_id">
                                        <option selected disabled>select category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control" name="type">
                                        <option selected disabled>select question type</option>
                                        <option value="main">Main</option>
                                        <option value="spare">Spare</option>
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



