@extends('layouts.dashboard')

@section('sub-content')

	<div class="row mt">
        <div class="col-lg-9">
		
		{{-- Empire Overview Template specific elements start. --}}
		
		<div id='solar-system-view-container'>
		
			<div id='planets-view-container'>
				<div id='planets-view-inner-container'>
				
				
					@foreach ($systemPlanets as $planet)
					
						<div class='planet-view-cell'>
							<img class='planet-view-planet-image' src='{{ URL::asset($planet->img_path) }}' onclick='RedirectToPlanetView({{ $planet->id }})'/>
							<p class='planet-view-planet-name'>{{ $planet->name }}</p>
						</div>
					
					@endforeach
				
					{{-- Planet cell template.
					<div class='planet-view-cell'>
						<img class='planet-view-planet-image' src='{{ URL::asset(<Image path>) }}' onclick='RedirectToPlanetView(<planet id>)'/>
						<p class='planet-view-planet-name'>Planet Name</p>
					</div>
					--}}
				</div>
			</div>
			
			<div id='planets-info-container'>
				<div id='planets-info-inner-container'>
					
				</div>
			</div>
		
		</div>
		
		{{-- Empire Overview Template specific elements end. --}}
		
		</div>
        {{--@include('partials.right-sidebar')--}}
    </div>
	
	<script type='text/javascript'>
		@if (isset($showRightPanel))
			document.getElementById('planets-info-container').style.display = 'none';
		
			document.getElementById('planets-view-container').style.width = '100%';
			document.getElementById('planets-view-container').style.borderStyle = 'none';
		@endif
	
		function RedirectToPlanetView(planet_id)
		{
			window.location.href = ('/galaxy-map/{{ $system_id }}/' + planet_id);
		}
	</script>

@endsection