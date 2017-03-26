@extends('layouts.home')

@section('main')

    <fleets-view user-id="{{Auth::user()->id}}"></fleets-view>

@endsection
