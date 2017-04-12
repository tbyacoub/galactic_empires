@extends('layouts.dashboard')

@section('sub-content')

	@foreach($solarSystem as $chunk)
		<div class="row mt">
			@foreach($chunk as $planet)
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">
					<div class="photo-wrapper">
						<a href="{{ url('planets/'.$planet->id) }}"><img class="img-responsive" src="{{ URL::asset($planet->planetType->img_path) }}"></a>
					</div>
					<h4 class="text-center">{{ $planet->name }}</h4>
				</div>
			@endforeach
		</div>
	@endforeach

@endsection