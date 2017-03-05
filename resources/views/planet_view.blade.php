@extends('layouts.dashboard')

@section('sub-content')

	<div class="row mt">
        <div class="col-lg-9">
		
		{{-- Planet Overview Template specific elements start. --}}
		
		<div id='planet_overview_container'>
			<div id='planet_name_container'>{{ $planetName->name }} System</div>
			
			<div id='planet_inline_container'>
				<div id='planet_image_container' style="background-image: url({{ URL::asset('img/star_backdrop.png') }})">
					<img id='planet_image' src='{{ URL::asset("img/planet_test_image_5.png") }}'/>
				</div>
				
				<div id='planet_info_container'>
					
				</div>
			</div>
		</div>
		
		{{-- Planet Overview Template specific elements end. --}}
		
		</div>
        {{--@include('partials.right-sidebar')--}}
    </div>

@endsection