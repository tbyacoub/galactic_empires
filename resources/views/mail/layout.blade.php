@extends('layouts.dashboard')

@section('sub-content')
    <div class="row mt">
        <div class="col-sm-3">
            <section class="panel">
                <div class="panel-body">
                    <a href="{{ url('mail/create') }}"  class="btn btn-compose">
                        <i class="fa fa-pencil"></i>  Compose Mail
                    </a>
                    <ul class="nav nav-pills nav-stacked mail-nav">
                        <li class="active"><a href="{{ url('mail') }}">
                                <i class="fa fa-inbox"></i>Inbox<span class="label label-theme pull-right inbox-notification">{{ Auth::user()->unReadMail()->count() }}</span></a>
                        </li>
                        <li><a href="{{ url('mail/sent') }}"> <i class="fa fa-envelope-o"></i>Send Mail</a></li>
                    </ul>
                </div>
            </section>
        </div>
        <div class="col-sm-9">
            @yield('mail-content')
        </div>
    </div>

@endsection