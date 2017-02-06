<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/lineicons/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style-responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/zabuto_calendar.css') }}">


    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};
    </script>
</head>
<body>
<div id="app">
    <!--header start-->
    @include('partials.header')
    <!--header end-->

        <!--main content start-->
    @yield('content')
    <!--main content end-->
</div>

<!-- js placed at the end of the document so the pages load faster -->
<script src="{{ URL::asset('js/app.js') }}"></script>
<script src="{{ URL::asset('js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{ URL::asset('js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.nicescroll.js') }}"></script>
<script src="{{ URL::asset('js/common-scripts.js') }}"></script>

</body>
</html>
