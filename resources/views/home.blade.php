@extends('layouts.dashboard')
@section('sub-content')
    <section id="main-content">
        <section class="wrapper">

            <div class="row">
                <div class="col-lg-9 main-chart">

                    <div class="row mtbox">
                        <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                            <div class="box1">
                                <span class="fa fa-users"></span>
                                <h3>{{ $users }}</h3>
                            </div>
                            <p>{{ $users }} Registered Users. Whoohoo!</p>
                        </div>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <span class="fa fa-star"></span>
                                <h3>{{ $solarSystems }}</h3>
                            </div>
                            <p>{{ $solarSystems }} Solar Systems in our game.</p>
                        </div>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <span class="fa fa-globe"></span>
                                <h3>{{ $planets }}</h3>
                            </div>
                            <p>{{ $planets }} In our database.</p>
                        </div>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <span class="fa fa-bolt"></span>
                                <h3>{{ $planetTypes }}</h3>
                            </div>
                            <p>{{ $planetTypes }} Planet Types to chose from.</p>
                        </div>

                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <span class="fa fa-database"></span>
                                {{--<span class="li_data"></span>--}}
                                <h3>{{ $planetsOwened }}</h3>
                            </div>
                            <p>You own {{ $planetsOwened }} planets.</p>
                        </div>

                    </div><!-- /row mt -->

                </div><!-- /col-lg-9 END SECTION MIDDLE -->

                {{-- Right sidebar start --}}
                @include('partials.right-sidebar')
                {{-- Right sidebar end --}}

            </div><! --/row -->
        </section>
    </section>
@endsection