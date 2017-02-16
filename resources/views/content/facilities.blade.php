@extends('layouts.dashboard')

@section('page_specific_css')

    <link href="{{ URL::asset('css/galaxy-map.css') }}" rel="stylesheet">

@endsection

@section('sub-content')

    <div class="row mt">
        <div class="col-lg-9" align="center">

            {{-- Facilities Page specific elements start. --}}

            <div id='facilities-content-page' style="border: 2px solid black; width: 800px; height: 600px;">



            </div>

            <br>

            {{-- This view is Temporary--}}
            <h4>** TEMP ** </h4>
            @include('admin.admin-sections.edit-planets-list')

            {{-- Facilities Page specific elements end. --}}

        </div>
        @include('partials.right-sidebar')
    </div>

    <script type='text/javascript' src='{{ URL::asset("js/jquery-3.1.1.js") }}'></script>

@endsection