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
            <div class="content-panel player-view-container">

                <img id="view-img" src="" alt="Facilities Image">



                <div class="buildings-container">

                    @foreach($buildings as $building)
                        <div class="building-container">
                            <div class="white-panel pn" style="height: 95%;">
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


                </div><!-- /content-panel -->

            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- /row -->

@endsection


<style rel="stylesheet/css">

    .player-view-container{
        min-height: 800px;
    }

    #view-img{
        width: 96%;
        height: 440px;
        margin: 2% 2% 0 2%;
    }

    .buildings-container{
       /*// border: 2px solid black;*/
        height: 304px;
        margin: 2%;
    }

    .building-container{
        width: 19.5%;
        display: inline-block;
    }

    .building-img{
        height: 60%;
        width: 60%;
        border: 2px solid darkgoldenrod;
    }

</style>