@extends('layouts.app')

@section('content')

    @<!--sidebar start-->
    @include('partials.sidebar')
    <!--sidebar end-->

    {{--<!--sub content start-->--}}
    {{--@yield('sub-content')--}}
    {{--<!--sub content end-->--}}

    <section id="main-content">
        <section class="wrapper">

            <div class="row">
                <div class="col-lg-9 main-chart">
                    @yield('sub-content')
                </div><!-- /col-lg-9 END SECTION MIDDLE -->

                {{-- Right sidebar start --}}
                @include('partials.right-sidebar')
                {{-- Right sidebar end --}}
            </div><! --/row -->

        </section>
    </section>

    <!--footer start-->
    @include('partials.footer')
    <!--footer end-->

@endsection