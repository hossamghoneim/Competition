@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-question" aria-hidden="true"></i>
                                <span class="Create-pk"> Questions</span>
                            </h3>

                            <div class="card-tools card-light">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">

                                    </div>
                                    <!-- /btn-group -->

                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0 ">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <td>{{$question->category->name}}</td>
                                        <td>{{$question->description}}</td>
                                        <td>{{$question->type}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <div class="">
                                {!!$questions->render('pagination::bootstrap-5')!!}
                            </div>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection
