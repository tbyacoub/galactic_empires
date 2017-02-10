@extends('mail.layout')

@section('mail-content')
        <section class="panel">
            <header class="panel-heading wht-bg">
                <h4 class="gen-case"> View Message
                    <form action="#" class="pull-right mail-src-position">
                        <div class="input-append">
                            <input type="text" class="form-control " placeholder="Search Mail">
                        </div>
                    </form>
                </h4>
            </header>
            <div class="panel-body ">

                <div class="mail-header row">
                    <div class="col-md-8">
                        <h4 class="pull-left">{{ $mail->subject }}</h4>
                    </div>
                </div>
                <div class="mail-sender">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="assets/img/ui-zac.jpg" alt="">
                            <strong>{{ $mail->sender()->first()->name }}</strong>
                            <span>[{{ $mail->sender()->first()->email }}]</span>
                            to
                            <strong>me</strong>
                        </div>
                        <div class="col-md-4">
                            <p class="date">{{ $mail->created_at }}</p>
                        </div>
                    </div>
                </div>
                <div class="view-mail">
                    {{ $mail->message }}
                </div>
                <div class="compose-btn pull-left">
                    <a href="{{ url('mail/create/'.$mail->sender()->first()->email) }}" class="btn btn-sm btn-theme" ><i class="fa fa-reply"></i> Reply</a>
                    <button class="btn btn-sm " ><i class="fa fa-arrow-right"></i> Forward</button>
                    <button class="btn btn-sm tooltips" data-original-title="Trash" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-trash-o"></i></button>
                </div>
            </div>
        </section>
@endsection