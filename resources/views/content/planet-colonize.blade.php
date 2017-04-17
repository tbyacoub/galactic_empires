@extends('layouts.dashboard')

@section('sub-content')

    <div class="row mt">
        <div class="col-lg-9">

        <h2>Attempt to Colonize {{ $colonize_planet->name }}</h2>
        <h3>Costs</h3>
        <div>
            <div>Metal Cost to Colonize: {{ \App\Traits\Colonizeable::metalCost() }} </div>
            <div>Crystal Cost to Colonize: {{ \App\Traits\Colonizeable::crystalCost() }} </div>
            <div>Energy Cost to Colonize: {{ \App\Traits\Colonizeable::energyCost() }} </div>
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h3>Select your planet that will initialize the Colonization.</h3>
        <table class="table table-striped table-advance table-hover">
            <thead>
            <tr>
                <th>Image</th>
                <th>Planet Name</th>
                <th>Metal</th>
                <th>Crystal</th>
                <th>Energy</th>
                <th>Colonize From</th>
                <th>Estimated Time</th>
            </tr>
            </thead>
            <tbody>

            @foreach(Auth::user()->planets()->get() as $planet)
                @if(!$planet->isBeingColonized() )
                <tr>
                    <td><img src="{{ URL::asset($planet->PlanetType()->first()->img_path) }}" alt="Planet Image" style="width:75px;height:75px;"></td>
                    <td>{{ $planet->name }}</td>
                    <td>
                        <div>{{ $planet->metal() }} / {{$planet->metal_storage}}</div>
                    </td>
                    <td>
                        <div>{{ $planet->crystal() }} / {{$planet->crystal_storage}}</div>
                    </td>
                    <td>
                        <div>{{ $planet->energy() }} / {{$planet->energy_storage}}</div>
                    </td>
                    <td>
                        <form class="form-horizontal style-form" method="POST" action="{{ url('/planets/' . $colonize_planet->id. '/colonize/' . $planet->id) }}">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}

                            <div>
                                <button id='colonize_link' type="submit" class="btn btn-info">Colonize From This</button>
                            </div>
                        </form>
                    </td>
                    <td>
                        {{ \Carbon\Carbon::now()->addMinutes(\App\Travel::time($colonize_planet, $planet))->diffForHumans() }}
                    </td>
                </tr>
                @endif
            @endforeach

            </tbody>
        </table>
        </div>
    </div>
@endsection