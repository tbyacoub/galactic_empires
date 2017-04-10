@extends('layouts.dashboard')

@section('sub-content')

    @if(Auth::user()->tutorial_complete == false)
        <div class="row mt">
            @include('content.tutorial')
        </div>
    @endif

    @if( Request::path() !=  'galaxy-map' )
        <div class="row mt">
            <user-control :planets="{{Auth::user()->planets()->with('fleets')->get()}}" user-id="{{Auth::user()->id}}"></user-control>
        </div>
    @endif

    <div class="row mt">
        @yield('main')
    </div>

    @if( Request::path() ==  'home' )
        <div class="row mt">
            {{--@include('content.fleet-travel')--}}
            <travels user-id="{{Auth::user()->id}}"></travels>
        </div>
    @endif

@endsection
