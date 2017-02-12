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
				
					
					<div class='system-icon-container'>
						<div></div>
					</div>
					
				</div>
				
			</div>
			
		</div>
		
		{{-- Galaxy Page specific elements end. --}}
		
		</div>
        @include('partials.right-sidebar')
    </div>

 

@endsection