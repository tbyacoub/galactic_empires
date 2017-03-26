@extends('layouts.dashboard')

@section('sub-content')

	<div class="row mt">
        <div class="col-lg-9">
		
		<div id='solar-system-view-container'>
		
			<div id='planets-view-container'>
				<div id='planets-view-inner-container'>
					@foreach ($solarSystem->planets()->get() as $planet)

						<div class='planet-view-cell'>
							<img class='planet-view-planet-image' src='{{ URL::asset($planet->planetType()->first()->img_path) }}' onclick='RedirectToPlanetView({{ $planet->id }})'/>
							<p class='planet-view-planet-name'>{{ $planet->name }}</p>
						</div>

					@endforeach
				</div>
			</div>
			
			<div id='planets-info-container'>
				<div id='planets-info-inner-container'>
					
				</div>
			</div>
		
		</div>
		
		</div>
    </div>
	
	<script type='text/javascript'>
		@if (isset($showRightPanel))
			document.getElementById('planets-info-container').style.display = 'none';
		
			document.getElementById('planets-view-container').style.width = '100%';
			document.getElementById('planets-view-container').style.borderStyle = 'none';
		@endif
	
		function RedirectToPlanetView(planet_id)
		{
			window.location.href = ('/planets/' + planet_id);
		}
	</script>

@endsection