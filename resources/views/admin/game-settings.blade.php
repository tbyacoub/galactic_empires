@extends('layouts.dashboard')

@section('sub-content')

    <global-rates :settings="{{$globals}}"></global-rates>

@endsection