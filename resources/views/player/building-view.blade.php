@extends('layouts.dashboard')

@section('sub-content')

    <link href="css/buildings.css" rel="stylesheet">
    <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <h3><i class="fa fa-angle-right"></i> Facilities </h3>

            <div class="content-panel" id="player-view-container">

                <div class="row mt">

                    <div class="col-md-6">
                        <img id="view-img" src="" alt="Facilities Image">
                    </div>

                    <div class="col-md-6">
                        <h1>View Description</h1>
                        <h4> Anti-Air Missiles : asldjfaklsdflkasdf</h4>
                        <hr>
                        <h4> Research Station : asldjfaklsdflkasdf</h4>
                        <hr>
                        <h4> Alloy Lab : asldjfaklsdflkasdf</h4>
                        <hr>
                        <h4> etc..</h4>
                    </div>

                </div>


                <div class="row mt" id="buildings-container">

                    @foreach($buildings as $building)
                        <div class="building-container">
                            <div class="white-panel pn" >
                                <div class="white-header">
                                    <h5>{{ $building->name() }}</h5>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-6 goleft">
                                        <p><i class="fa fa-gavel"></i> Level : {{ $building->current_level }}</p>
                                    </div>
                                    <div class="col-sm-6 col-xs-6"></div>
                                </div>
                                <div class="centered">
                                    <img class="building-img" src="" alt="{{ $building->img() }}">
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div><!-- /content-panel -->

@endsection
