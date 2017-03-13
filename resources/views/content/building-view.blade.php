@extends('layouts.home')

@section('main')

    <building-view user-id="{{Auth::user()->id}}" building-type="{{$type}}"></building-view>

@endsection
