@extends('layouts.dashboard')

@section('sub-content')

	<div class="row mt">
		<div class="col-lg-9">

			{{-- Planet Overview Template specific elements start. --}}

			<div id='planet_overview_container'>
				<div id='planet_name_container'>{{ $planet->name }}</div>

				<div id='planet_inline_container'>
					<div id='planet_image_container' style="background-image: url({{ URL::asset('img/star_backdrop.png') }})">
						<img id='planet_image' src='{{ URL::asset($planet->PlanetType()->first()->img_path) }}'/>
					</div>

					<div id='planet_info_container'>
						@if($planet->user()->count() == 0)
							<div id='planet_owner_name'>Owner: uninhabited</div>
						@elseif ($planet->user()->first()->id == Auth::id())
							<div id='planet_owner_name'>Owner: Planet is owned by you</div>
						@else
							<div id='planet_owner_name'>Owner: {{ $planet->user()->first()->name }}</div>
						@endif
						<div id='solar_system_name'>Solar System: {{ $planet->SolarSystem()->first()->name }}</div>
						<div id='solar_system_location'>System Location: {{ $planet->SolarSystem()->first()->location[0] .', '. $planet->SolarSystem()->first()->location[0]}}</div>
						<div class='info_line_breaker'></div>

						<div id='planet_radius'>Planet Radius: {{ $planet->radius }}</div>

						<div class='info_line_breaker'></div>
						<div id='planet_resources_header'>Planetary Resources:</div>
						<div id='planet_metal'>Metal: {{ $planet->metal() }}</div>
						<div id='planet_crystal'>Crystal: {{ $planet->crystal() }}</div>
						<div id='planet_energy'>Energy: {{ $planet->energy() }}</div>
						@if ($planet->user()->count() > 0 && !($planet->user()->first()->id == Auth::id()))
							@if ($planet->user_id >= 0 && $planet->colonized == true)
								<div class='info_line_breaker'></div>
								<div id='attack_button_container'>
									<a id='attack_link' href="{{ url('/travels/create/'.$planet->id) }}">Attack</a>
								</div>
							@else
								<hr>
								<div> Planet is being colonized by {{ $planet->user()->name }}</div>
							@endif
                        @elseif ($planet->user()->count() > 0 && $planet->colonized == false && $planet->user()->first()->id == Auth::id())
                            <hr>
                            <div> You're currently colonizing this Planet</div>
						@elseif ($planet->user_id < 0)
							<hr>
							<h3>Colonize Planet</h3>
							<div>Metal Cost to Colonize: {{ \App\Traits\Colonizeable::metalCost() }} </div>
							<div>Crystal Cost to Colonize: {{ \App\Traits\Colonizeable::crystalCost() }} </div>
							<div>Energy Cost to Colonize: {{ \App\Traits\Colonizeable::energyCost() }} </div>

							<div class='info_line_breaker'></div>
							<div id='colonize_button_container'>
								<a id='colonize_link' href='{{ url('/planets/'. $planet->id .'/colonize') }}'>Colonize</a>
							</div>
						@endif
					</div>
				</div>
			</div>

			{{-- Planet Overview Template specific elements end. --}}

		</div>
	</div>

@endsection