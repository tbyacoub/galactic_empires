@extends('layouts.dashboard')

@section('sub-content')

    {{--<h3><i class="fa fa-angle-right"></i> Admin : Game Speed Settings</h3>--}}

    {{--<!-- BASIC FORM ELELEMNTS -->--}}
    {{--<div class="row mt">--}}
        {{--<div class="col-lg-12">--}}
            {{--<div class="form-panel">--}}
                {{--<h4 class="mb"><i class="fa fa-angle-right"></i> Global Game Settings</h4>--}}

                {{--<form class="form-horizontal style-form" method="POST" action="{{ url('/global-rates') }}">--}}

                    {{--{{ csrf_field() }}--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 col-sm-2 control-label">Metal Gather Rate</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input type="text" class="form-control" name="metal_rate" placeholder="Current: {{$globals[0]->metal_rate}}" value="">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 col-sm-2 control-label">Crystal Gather Rate</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input type="text" class="form-control" name="crystal_rate" placeholder="Current: {{$globals[0]->crystal_rate}}" value="">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 col-sm-2 control-label">Energy Gather Rate</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input type="text" class="form-control" name="energy_rate" placeholder="Current: {{$globals[0]->energy_rate}}" value="">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 col-sm-2 control-label">Ship Build Rate</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input type="text" class="form-control" name="ship_build_time_rate" placeholder="Current: {{$globals[0]->ship_build_time_rate}}" value="">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 col-sm-2 control-label">Ship Build Cost Rate</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input type="text" class="form-control" name="ship_cost_rate" placeholder="Current: {{$globals[0]->ship_cost_rate}}" value="">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 col-sm-2 control-label">Building Build Time Rate</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input type="text" class="form-control" name="building_build_time_rate" placeholder="Current: {{$globals[0]->building_build_time_rate}}" value="">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 col-sm-2 control-label">Building Cost Rate</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input type="text" class="form-control" name="building_cost_rate" placeholder="Current: {{$globals[0]->building_cost_rate}}" value="">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 col-sm-2 control-label">Research Rate</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input type="text" class="form-control" name="research_rate" placeholder="Current: {{$globals[0]->research_rate}}" value="">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 col-sm-2 control-label">Travel Rate</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input type="text" class="form-control" name="travel_rate" placeholder="Current: {{$globals[0]->travel_rate}}" value="">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<input class="btn btn-default btn-lg" type="submit" value="Update Settings">--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div><!-- col-lg-12-->--}}
    {{--</div><!-- /row -->--}}

@endsection