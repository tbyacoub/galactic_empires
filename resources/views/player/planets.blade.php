<table class="table table-striped table-advance table-hover">

	<thread>
		<tr>
		<th>Image</th>
		<th>Planet Name</th>
		<th>Solar System Name</th>
		@foreach($user->planets()->first()->fleets()->get() as $fleet)
			<th>{{ $fleet->description->name }}</th>
		@endforeach
		{{-- <th>Babylon5</th>
		<th>Battlestar Galactica</th>
		<th>Stargate</th> --}}
		<th>Metal</th>
		<th>Crystal</th>
		<th>Energy</th>
		<tr>
	</thread>

	<tbody>
		
		@foreach($user->planets()->get() as $planet)
			<tr>
				<td><img src="{{ $planet->PlanetType()->first()->img_path }}" alt="Planet Image" style="width:75px; height: 75px;"></td>
				<td>{{ $planet->name }}</td>
				<td>{{ $planet->solarSystem()->first()->name }}</td>
				@foreach($planet->fleets()->get() as $fleet)
					<td>{{ $fleet->count }}</td>
				@endforeach
				<td>{{ $planet->metal() }}</td>
				<td>{{ $planet->crystal() }}</td>
				<td>{{ $planet->energy() }}</td>

		@endforeach

	</tbody>


</table>
