@extends('layouts.home')

@section('main')

	<planet-overview user-id="{{Auth::user()->id}}"></planet-overview>

@endsection