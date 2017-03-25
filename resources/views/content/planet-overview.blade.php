@extends('layouts.dashboard')

@section('sub-content')

    <div class="row mt">
        <a class="btn btn-danger" href="/launch-attack/{{ Auth::user()->planets()->first()->id }}/{{$planet->id}}">Attack {{ $planet->name }}</a>
    </div>
@endsection
