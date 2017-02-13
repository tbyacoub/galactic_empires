@extends('mail.layout')

@section('mail-content')
        <section class="panel">
            <header class="panel-heading wht-bg">
                <h4 class="gen-case"> View Message</h4>
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

                    <a href="{{ url('mail/create/'.$mail->sender()->first()->email) }}" class="btn btn-sm btn-theme" ><i class="fa fa-reply"></i>Reply</a>
                    <form action="{{ url('mail/create') }}" method="post" style="display: inline">
                        <input type="hidden" name="mailId" value="{{$mail->id}}">
                        {{ csrf_field() }}
                        <button class="btn btn-sm btn-theme"  type="submit"><i class="fa fa-arrow-right"></i>Forward</button>
                    </form>
                    <form action="{{ url('mail/'.$mail->id) }}" method="post" style="display: inline">
                        <input type="hidden" name="_method" value="DELETE">
                        {{ csrf_field() }}
                        <button class="btn btn-sm tooltips"  type="submit"><i class="fa fa-trash-o"></i></button>
                    </form>

                </div>
            </div>
        </section>
@endsection