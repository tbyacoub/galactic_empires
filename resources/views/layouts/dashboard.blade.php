@extends('layouts.app')

@section('content')

    @<!--sidebar start-->
    @include('partials.sidebar')
    <!--sidebar end-->

    <!--sub content start-->
    @yield('sub-content')
    <!--sub content end-->

    <!--footer start-->
    @include('partials.footer')
    <!--footer end-->

@endsection