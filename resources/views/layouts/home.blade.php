@extends('layouts.dashboard')

@section('sub-content')
    <div class="row mt">
        <user-control :planets="{{Auth::user()->planets()->with('fleets')->get()}}" user-id="{{Auth::user()->id}}"></user-control>
    </div>
    <div class="row mt">
        @yield('main')
    </div>

    @if( Request::path() ==  'home' )
    <div class="row mt">
        @include('content.fleet-travel')
    </div>
    @endif

@endsection
