@extends('layouts.dashboard')

@section('sub-content')
    <div class="row mt">
        <user-control :planets="{{Auth::user()->planets()->get()}}" user-id="{{Auth::user()->id}}"></user-control>
    </div>
    <div class="row mt">
        @yield('main')
    </div>
@endsection
