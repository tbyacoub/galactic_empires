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
			
			
			
			
		</div>
		
		{{-- Galaxy Page specific elements end. --}}
		
		</div>
        @include('partials.right-sidebar')
    </div>

 

@endsection