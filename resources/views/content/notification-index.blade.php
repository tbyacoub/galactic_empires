@extends('layouts.dashboard')

@section('sub-content')

    <div class="row mt content-panel">
        <h2 class="centered">Notifications</h2>
        <div class="col-md-10 col-md-offset-1 mt mb">
            <div class="accordion" id="accordion2">
                @foreach($notifications as $notification)
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="faq.html#collapseOne">
                                <em class="fa fa-arrow-circle-right"></em>{{$notification->subject}}
                            </a>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse in">
                            <div class="accordion-inner">
                                <p>{{$notification->content}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
