@extends('layouts.app-without-sidebar')

@section('content')

    <section class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Competition</h3>
                        </div>
                        <div class="card-body">
                            <h3>Start Competition</h3>

                            <a class="btn btn-app" href="{{ route('competition.start') }}">
                                <i class="fas fa-play"></i> Play
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection
