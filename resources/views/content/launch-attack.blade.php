@extends('layouts.home')

@section('main')

    <attack :destination="{{$planet->id}}"></attack>

@endsection