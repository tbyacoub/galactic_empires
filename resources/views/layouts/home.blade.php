@extends('layouts.dashboard')

@section('sub-content')

    @if(Auth::user()->tutorial_complete == false)
        @include('content.tutorial')
    @endif

    <div class="row mt">
        <user-control :user_id="{{Auth::id()}}" :planets="{{$planets}}"></user-control>
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
