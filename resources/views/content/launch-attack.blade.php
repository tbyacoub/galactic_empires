@extends('layouts.dashboard')

@section('sub-content')

    <div class="col-lg-12">
        <div class="row content-panel">
            <div class="col-md-6 profile-text mt mb">
                <div class="btn-group">
                    <h3>Select Planet to Launch Attack From: <br> <strong>{{ $from_planet->name }}</strong></h3>
                    <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown">
                        Select Planet <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        @foreach(Auth::user()->planets()->get() as $planet)
                            <li><a href="/launch-attack/{{ $planet->id }}/{{$to_planet->id}}">{{ $planet->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="row content-panel">
            <div class="col-md-6 profile-text mt mb">

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h4 class="mb"><i class="fa fa-angle-right"></i> {{ $from_planet->name }}'s Fleet</h4>
                <form class="form-horizontal style-form" method="post" action="{{ url('launch-attack/'.$from_planet->id.'/'.$to_planet->id) }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Fighters <span class="badge bg-inverse">{{ $from_planet->numFrigates }}</span></label>
                        <div class="col-sm-4">
                            <input type="text" name="fighters" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Bombers <span class="badge bg-inverse">{{ $from_planet->numBombers }}</span></label>
                        <div class="col-sm-4">
                            <input type="text" name="bombers" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Corvettes <span class="badge bg-inverse">{{ $from_planet->numCorvettes }}</span></label>
                        <div class="col-sm-4">
                            <input type="text" name="corvettes" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Frigates <span class="badge bg-inverse">{{ $from_planet->numFrigates }}</span></label>
                        <div class="col-sm-4">
                            <input type="text" name="frigates" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Destroyers <span class="badge bg-inverse">{{ $from_planet->numDestroyers }}</span></label>
                        <div class="col-sm-4">
                            <input type="text" name="destroyers" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger btn-md btn-block">Dispatch Fleet to Attack</button>
                </form>

                <div id="slider"></div>

            </div>

            <div class="col-md-6 profile-text mt mb">

                <h4 class="mb"><i class="fa fa-angle-right"></i> Enemy Planet</h4>
                <div>
                    <h2>{{$to_planet->name}}</h2>
                </div>
            </div>


        </div>

    </div>


@endsection
