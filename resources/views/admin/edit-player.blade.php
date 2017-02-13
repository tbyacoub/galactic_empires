@extends('layouts.dashboard')

@section('sub-content')

@if(isset($user))
<div class="row mt">

    {{-- TOP SECTION START--}}
    <div class="col-lg-12">
        <div class="row content-panel">

            <div class="col-md-4 profile-text mt mb centered">
                <div class="right-divider hidden-sm hidden-xs">
                    <h4>{{ $user->planetsCount() }}</h4>
                    <h6>Planets</h6>
                    <h4>###</h4>
                    <h6>Ships</h6>
                    <h4>###</h4>
                    <h6>PLACEHOLDER</h6>
                </div>
            </div><! --/col-md-4 -->

            <div class="col-md-4 profile-text">
                <h3>{{ $user->name }}</h3>
                <h6>{{ $user->cachedRoles()[0]->display_name }}</h6>
                <p>USER BIO</p>
                <br>
                <p><button class="btn btn-theme"><i class="fa fa-envelope"></i> Send Message</button></p>
            </div><! --/col-md-4 -->

            <div class="col-md-4 centered">
                <div class="right-divider hidden-sm hidden-xs">
                    <h4>{{ $user->metal() }}</h4>
                    <h6>Total Metal</h6>
                    <h4>{{ $user->wood() }}</h4>
                    <h6>Total Wood</h6>
                    <h4>{{ $user->energy() }}</h4>
                    <h6>Total Energy</h6>
                </div>
            </div><! --/col-md-4 -->


        </div>
    </div>
    {{-- TOP SECTION END --}}

    @if(Auth::user()->hasRole('admin'))
    <div class="col-lg-12 mt">
        <div class="row content-panel">
            <div class="panel-heading">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a data-toggle="tab" href="#planets">Planets</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#bonuses" class="contact-map">Bonuses</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#account">Account</a>
                    </li>
                </ul>
            </div><! --/panel-heading -->

            <div class="panel-body">
                <div class="tab-content">

                    {{--PLANETS START--}}
                    <div id="planets" class="tab-pane active">
                        <div class="row">

                            @include('admin.admin-sections.edit-planets-list')

                        </div><! --/OVERVIEW -->
                    </div><! --/tab-pane -->
                    {{-- PLANETS END--}}

                    {{-- BONUSES START--}}
                    <div id="bonuses" class="tab-pane">
                        <div class="row">

                        </div><! --/row -->
                    </div><! --/tab-pane -->
                    {{-- BONUSES END--}}

                    {{-- ACCOUNT START--}}
                    <div id="account" class="tab-pane">
                        <div class="row">

                        </div><! --/row -->
                    </div><! --/tab-pane -->
                    {{--ACCOUNT END--}}


                </div><!-- /tab-content -->
            </div><! --/panel-body -->
        </div><!-- /col-lg-12 -->
    </div><! --/row -->
    @endif
</div><! --/container -->
@endif

<script type='text/javascript' src='{{ URL::asset("js/jquery-3.1.1.js") }}'></script>
<script type='text/javascript' src='{{ URL::asset("js/edit-player.js") }}'></script>


@endsection