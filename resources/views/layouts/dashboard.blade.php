@extends('layouts.app')

@section('content')

    <!--sidebar start-->
    @include('partials.sidebar')
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">
            <div class="row mt">
                <div class="col-lg-9">
                    @yield('sub-content')
                </div>
                @include('partials.right-sidebar')
            </div>

        </section>
    </section>
    <!--main content end-->

    <!--footer start-->
    @include('partials.footer')
    <!--footer end-->

@endsection