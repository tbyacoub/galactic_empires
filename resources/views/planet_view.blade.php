@extends('layouts.dashboard')

@section('sub-content')

	<div class="row mt">
        <div class="col-lg-9">
		
		{{-- Planet Overview Template specific elements start. --}}
		
		<div id='planet_overview_container'>
			<div id='planet_name_container'>{{ $planetName->name }} System</div>
			
			<div id='planet_info_outer_container'></div>
		</div>
		
		{{-- Planet Overview Template specific elements end. --}}
		
		</div>
        {{--@include('partials.right-sidebar')--}}
    </div>

@endsection