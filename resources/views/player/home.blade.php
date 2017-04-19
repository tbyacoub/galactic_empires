@extends('layouts.dashboard')
@section('sub-content')

<div class="row mt">
    <div class="col-lg-12">
        <div class="row content-panel">

            <div class="col-md-4 profile-text mt mb centered">
                <div class="right-dividerhidden-sm hidden-xs">
                    <h3>{{ $user->planetsCount() }}</h3>
                    <h6>Planets</h6>
                    <div class="col">
                        <h3>{{ $user->numBabylon5() }}</h3>
                    <h6>Babylon5 Fleets</h6>
                    </div>
                    <div class="col">
                        <h3> {{ $user->numBattlestarGalactica() }} </h3>
                        <h6>Battlestar Galactica Fleets</h6>
                    </div>
                    <div class="col">
                        <h3> {{ $user->numStargate() }}</h3> 
                        <h6>Stargate Fleets</h6>
                    </div>
                </div>
            </div>

            <div class="col-md-4 profile-text">
                <h3 align='center'>{{ $user->name }}</h3>
                <hr>
                {{-- @if($user->id != Auth::user()->id)
                    <br>
                    <div align="center"><a href="#" class="btn btn-primary" role="button">Message User</a></div>
                @endif --}}
                <br>
                <h4 align="center">Playing since {{ $user->created_at->toFormattedDateString() }}</h4>
            </div>

            <div class="col-md-4 centered">
                <div class="right-divider hidden-sm hidden-xs">
                <br>
                <br>
                <h4>Total Metal: {{ $user->metal() }}</h4>
                <br>
                <br>
                <h4>Total Crystal: {{ $user->crystal() }}</h4>
                <br>
                <br>
                <h4>Total Energy: {{ $user->energy() }}</h4>
                </div>
            </div>

        </div>
    </div>

    <div class="col-lg-12 mt">
        <div class="row content-panel">
            <div class="panel-heading">

                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a data-toggle="tab" href="#planets">Planets</a>
                    </li>
                    {{-- <li>
                        <a data-toggle="tab" href="#bonuses" class="contact-map">Buildings</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#account">Account</a>
                    </li> --}}
                </ul>
            </div>

            <div class="panel-body">
                <div class="tab-content">

                    <div id="planets" class="tab-pane active">
                        <div class="row">
                            @include('player.planets')
                        </div>
                    </div>

                    <div id="bonuses" class="tab-pane">
                        <div class="row">
                            <h6>Bonuses</h6>
                        </div>
                    </div>

                    <div id="account" class="tab-pane">
                        <div class="row">
                            <h6>Account</h6>
                        </div>
                    </div>
        </div>
    </div>

        

@endsection 