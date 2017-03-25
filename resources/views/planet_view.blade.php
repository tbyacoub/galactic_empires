@extends('layouts.dashboard')

@section('sub-content')

	<div class="row mt">
        <div class="col-lg-9">
		
		{{-- Planet Overview Template specific elements start. --}}
		
		<div id='planet_overview_container'>
			<div id='planet_name_container'>{{ $planetInfo->name }} System</div>
			
			<div id='planet_inline_container'>
				<div id='planet_image_container' style="background-image: url({{ URL::asset('img/star_backdrop.png') }})">
					<img id='planet_image' src='{{ URL::asset($planetInfo->img_path) }}'/>
				</div>
				
				<div id='planet_info_container'>
					@if ($ownedByUser)
						<div id='planet_owner_name'>Owner: Planet is owned by you</div>
					@elseif (isset($planetInfo->user_name))
						<div id='planet_owner_name'>Owner: {{ $planetInfo->user_name }}</div>
					@else
						<div id='planet_owner_name'>Owner: No one</div>
					@endif
					<div id='solar_system_name'>Solar System: {{ $solarSystemInfo->name }}</div>
					<div id='solar_system_location'>System Location: {{ $solarSystemInfo->location }}</div>
					<div class='info_line_breaker'></div>
					
					<div id='planet_radius'>Planet Radius: {{ $planetInfo->radius }}</div>
					
					@if (isset($planetInfo->resources))
						<div class='info_line_breaker'></div>
						<div id='planet_resources_header'>Planetary Resources:</div>
						<div id='planet_metal'>Metal: {{ json_decode($planetInfo->resources)->metal }}</div>
						<div id='planet_crystal'>Crystal: {{ json_decode($planetInfo->resources)->crystal }}</div>
						<div id='planet_energy'>Energy: {{ json_decode($planetInfo->resources)->energy }}</div>
					@endif
					
					@if (!$ownedByUser)
						@if (isset($planetInfo->user_name))
							<div class='info_line_breaker'></div>
							<div id='attack_button_container'>
								<a id='attack_link' href='#'>Attack</a>
							</div>
						@else
							<div class='info_line_breaker'></div>
							<div id='colonize_button_container'>
								<a id='colonize_link' href='#'>Colonize</a>
							</div>
						@endif
					@endif
				</div>
			</div>
		</div>
		
		{{-- Planet Overview Template specific elements end. --}}
		
		</div>
        {{--@include('partials.right-sidebar')--}}
    </div>

@endsection