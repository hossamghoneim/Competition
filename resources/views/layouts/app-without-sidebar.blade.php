<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    @stack('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('message')
    @include('errors')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-color: white">
        @yield('content')
    </div>

</div>

<script src="{{ asset('js/app.js') }}" defer></script>
@yield('javascript')

@stack('third_party_scripts')

@stack('page_scripts')
</body>
</html>
