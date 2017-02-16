@extends('layouts.app')

@section('content')

    <!--sidebar start-->
    @include('partials.sidebar')
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">
            <div class="col-lg-12">
                <div class="row mt">
                    <user-control :user="{{$user}}" :planets="{{$planets}}"></user-control>
                </div>
                <div class="row mt">
                    <div class="col-lg-12">
                        {{-- Insert view here--}}
                        @yield('sub-content')
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!--main content end-->

    <!--footer start-->
    @include('partials.footer')
    <!--footer end-->

@endsection