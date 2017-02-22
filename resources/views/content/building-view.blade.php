@extends('layouts.home')

@section('main')

    <link href="css/buildings.css" rel="stylesheet">
    <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <h3><i class="fa fa-angle-right"></i> {{ $type }} </h3>

    <div class="row mt">

        @foreach($buildings as $building)
            <div class="col-lg-4 col-md-4 col-sm-4 mb">
				<div class="content-panel pn">
					<div id="spotify" style="background: url({{ $building->img() }}) no-repeat center top">
						<div class="col-xs-4 col-xs-offset-8">
							<button class="btn btn-sm btn-clear-g">UPGRADE</button>
						</div>
						<div class="sp-title">
							<h3>{{ $building->name() }}</h3>
						</div>
						<div class="play">
							<i class="fa fa-play-circle"></i>
						</div>
					</div>
					<p class="followers"><i class="fa fa-user"></i>LEVEL {{ $building->current_level }}</p>
				</div>
			</div>
        @endforeach

    </div>


@endsection
