@extends('layouts.dashboard')

@section('sub-content')

    <div class="row mt">
        <div class="col-lg-9">

        <h2>Attempt to Colonize {{ $colonize_planet->name }}</h2>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-striped table-advance table-hover">
            <thead>
            <tr>
                <th>Image</th>
                <th>Planet Name</th>
                <th>Metal</th>
                <th>Crystal</th>
                <th>Energy</th>
                <th>Colonize From</th>
            </tr>
            </thead>
            <tbody>

            @foreach(Auth::user()->planets()->get() as $planet)
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
                </tr>
            @endforeach

            </tbody>
        </table>
        </div>
    </div>
@endsection