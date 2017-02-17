@extends('layouts.dashboard')

@section('sub-content')

	<div class="row mt">
        <div class="col-lg-9">
		
		{{-- Empire Overview Template specific elements start. --}}
		
		<div id='solar-system-view-container'>
		
			<div id='planets-view-container'>
				<div id='planets-view-inner-container'>
					<div class='planets-view-columns' style='background-color: red;'>
						<div class='planet-view-cell'></div>
						<div class='planet-view-cell'></div>
						<div class='planet-view-cell'></div>
					</div>
					<div class='planets-view-columns' style='background-color: blue;'>
						<div class='planet-view-cell'></div>
						<div class='planet-view-cell'></div>
					</div>
				</div>
			</div>
			
			<div id='planets-info-container'>
				<div id='planets-info-inner-container'>
					<div style='width: 100%; height: 350px; background-color: red;'></div>
				</div>
			</div>
		
		</div>
		
		{{-- Empire Overview Template specific elements end. --}}
		
		</div>
        @include('partials.right-sidebar')
    </div>

@endsection