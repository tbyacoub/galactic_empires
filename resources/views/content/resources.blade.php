@extends('layouts.dashboard')

@section('sub-content')
    <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
    <!--main content start-->

    <div class="row mt">
        <div class="col-md-12">
            <div class="panel-heading">
                <h3><i class="fa fa-angle-right"></i> Facilities </h3>

            </div>

            <div class="content-panel" id="player-view-container">

                <div class="row mt">

                    <div class="col-md-6">
                        <img id="view-img" src="" alt="Facilities Image">
                    </div>

                    <div class="col-md-6">
                        <h1>{{ $planet->name }}'s Resource Production</h1>
                        <hr>
                        <h4> Mineral Mine : 100 units per hour</h4>
                        <hr>
                        <h4> Crystal Mine : 25 units per hour</h4>
                        <hr>
                        <h4> Energy Reactor : 200 units per hour</h4>
                        <hr>
                        <h4> Solar Array: 150 units per hour</h4>
                        <hr>
                    </div>

                </div>

                <div class="row mt" id="buildings-container">
                    <h2>Resource Structures On {{ $planet->name }}</h2>
                    <hr>

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

               <h3>Available Resources on {{ $planet->name }}</h3>
                <table id="font-table">
                <tr>
                    <td align="center">Metal: {{ $planet->metal() }}</td>
                    <td align="center">Crystal: {{ $planet->crystal() }}</td>
                    <td align="center">Energy: {{ $planet->energy() }}</td>
                </tr>


            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- /row -->

@endsection

<style rel="stylesheet/css">

    #player-view-container{
        min-height: 800px;
        background-color: #ffd777;
    }

    #view-img{
        width: 95%;
        height: 400px;
        margin-left: 5%;
    }

    #buildings-container{
        height: 300px;
        margin: 3%;
        width: 95%;
        /*border: 2px solid black;*/
        overflow-x: hidden;
    }

    #font-table{
        border: 1px solid black;
        width: 100%;
    }

    .building-container{
        width: 19.5%;
        margin-top: 5px;
        display: inline-block;
    }

    .building-img{
        height: 60%;
        width: 60%;
        border: 2px solid darkgoldenrod;
    }
    

</style>


