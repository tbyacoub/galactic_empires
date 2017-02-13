@extends('layouts.dashboard')

@section('page_specific_css')

	<link href="{{ URL::asset('css/galaxy-map.css') }}" rel="stylesheet">

@endsection

@section('sub-content')

	<div class="row mt">
        <div class="col-lg-9">
		
		{{-- Galaxy Page specific elements start. --}}
		
		<div id='galaxy-map-content-container'>
		
			{{-- Galxy image. --}}
			<img id='galaxy-map-image' src='{{ URL::asset("img/galaxy-1440x1440.jpg") }}'/>
			
			{{-- Outer absolute container for elements that will overlay the galaxy map, such as solar system icons and popups. --}}
			<div id='galaxy-overlay-container'>
				
				{{-- Inner relative container. Solar system icons will be absolutely positioned and having a relative
				     parent changes their positioning to be relative to the parent. --}}
				<div id='galaxy-overlay-innter-container'>
				
					{{-- Template for system icon. Dynamically added over map by JQuery. --}}
					
					<!--
					<div class='system-icon-container'>
						<div class='system-icon-inner-container'></div>
					</div>
					-->
					
					<div id='popup-container'>
						<div id='popup-top-bar-container'>
							<div id='solar-system-name-container'>
								<p id='popup-system-name'>Terrell Hoppe</p>
							</div>
							<div id='popup-x-button-container'>
								<img id='popup-x-button' src='{{ URL::asset("img/popout_exit_button.png") }}'/>
							</div>
						</div>
						
						<div id='go-to-system-link-container'>
							<p id='go-to-system-link'>View System</p>
						</div>
					</div>
					
				</div>
				
			</div>
			
		</div>
		
		{{-- Galaxy Page specific elements end. --}}
		
		</div>
        @include('partials.right-sidebar')
    </div>
	
<script type='text/javascript' src='{{ URL::asset("js/jquery-3.1.1.js") }}'></script>
<script type='text/javascript' src='{{ URL::asset("js/galaxy-map.js") }}'></script>

<script type='text/javascript'>
	{{-- Pass the names and locations of solar systems to javascript. --}}
	var solarSystems = {!! json_encode($solarSystems->toArray()) !!};
</script>

@endsection