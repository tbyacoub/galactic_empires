@extends('layouts.home')

@section('main')

    <attack></attack>

        {{--<div class="row content-panel">--}}
            {{--<div class="col-md-6 profile-text mt mb">--}}

                {{--<h4 class="mb"><i class="fa fa-angle-right"></i> {{ $from_planet->name }}'s Fleet</h4>--}}
                {{--<form class="form-horizontal style-form" method="post" action="{{ url('launch-attack/'.$from_planet->id.'/'.$to_planet->id) }}">--}}
                    {{--{{ csrf_field() }}--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-3 col-sm-3 control-label"><span class="badge bg-inverse">{{ $from_planet->fleet('babylon5')->first()->count }}</span> Babylon 5</label>--}}
                        {{--<div class="col-sm-4">--}}
                            {{--<input type="text" name="babylon5" class="form-control">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-3 col-sm-3 control-label"><span class="badge bg-inverse">{{ $from_planet->fleet('battlestar_galactica')->first()->count }}</span> Battlestar Galactica</label>--}}
                        {{--<div class="col-sm-4">--}}
                            {{--<input type="text" name="battlestar_galactica" class="form-control">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-3 col-sm-3 control-label"> <span class="badge bg-inverse">{{ $from_planet->fleet('stargate')->first()->count }}</span> Stargate</label>--}}
                        {{--<div class="col-sm-4">--}}
                            {{--<input type="text" name="stargate" class="form-control">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<button type="submit" class="btn btn-danger btn-md btn-block">Dispatch Fleet to Attack</button>--}}
                {{--</form>--}}

                {{--<div id="slider"></div>--}}

            {{--</div>--}}

            {{--<div class="col-md-6 profile-text mt mb">--}}

                {{--<h4 class="mb"><i class="fa fa-angle-right"></i> Enemy Planet</h4>--}}
                {{--<div>--}}
                    {{--<h1>{{$to_planet->name}}</h1>--}}
                {{--</div>--}}

                {{--<h4 class="mb"><i class="fa fa-angle-right"></i> Time Distance</h4>--}}
                {{--<div>--}}
                    {{--<h2>{{ $from_planet->formattedTimeDistance($to_planet) }}</h2>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}

    {{--</div>--}}


@endsection