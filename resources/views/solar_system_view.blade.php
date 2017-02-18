@extends('layouts.dashboard')

@section('sub-content')

	<div class="row mt">
        <div class="col-lg-9">
		
		{{-- Empire Overview Template specific elements start. --}}
		
		<div id='solar-system-view-container'>
		
			<div id='planets-view-container'>
				<div id='planets-view-inner-container'>
					<div class='planets-view-columns'>
						<div class='planet-view-cell'>
							<img class='planet-view-planet-image' src='{{ URL::asset("img/planet_test_image_1.png") }}'/>
							<p class='planet-view-planet-name'>Aurelius Prime</p>
						</div>
						<div class='planet-view-cell'>
							<img class='planet-view-planet-image' src='{{ URL::asset("img/planet_test_image_2.png") }}'/>
							<p class='planet-view-planet-name'>Sigma VII</p>
						</div>
						<div class='planet-view-cell'>
							<img class='planet-view-planet-image' src='{{ URL::asset("img/planet_test_image_3.png") }}'/>
							<p class='planet-view-planet-name'>Taran'tuu</p>
						</div>
					</div>
					<div class='planets-view-columns'>
						<div class='planet-view-cell'>
							<img class='planet-view-planet-image' src='{{ URL::asset("img/planet_test_image_4.png") }}'/>
							<p class='planet-view-planet-name'>Ciirda</p>
						</div>
						<div class='planet-view-cell'>
							<img class='planet-view-planet-image' src='{{ URL::asset("img/planet_test_image_5.png") }}'/>
							<p class='planet-view-planet-name'>Beta III - Raz</p>
						</div>
					</div>
				</div>
			</div>
			
			<div id='planets-info-container'>
				<div id='planets-info-inner-container'>
					<p style='font-size: 20px'>Hello</p>
				</div>
			</div>
		
		</div>
		
		{{-- Empire Overview Template specific elements end. --}}
		
		</div>
        @include('partials.right-sidebar')
    </div>

@endsection