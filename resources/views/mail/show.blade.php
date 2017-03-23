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
                @can('delete', $mail)
                    <div class="compose-btn pull-left">

                        <form action="{{ url('mails/create') }}" method="post" style="display: inline">
                            <input type="hidden" name="mailId" value="{{$mail->id}}">
                            <input type="hidden" name="_CMETHOD" value="REPLY">
                            {{ csrf_field() }}
                            <button class="btn btn-sm btn-theme"  type="submit"><i class="fa fa-reply"></i>Reply</button>
                        </form>

                        <form action="{{ url('mails/create') }}" method="post" style="display: inline">
                            <input type="hidden" name="mailId" value="{{$mail->id}}">
                            <input type="hidden" name="_CMETHOD" value="FORWARD">
                            {{ csrf_field() }}
                            <button class="btn btn-sm btn-theme"  type="submit"><i class="fa fa-arrow-right"></i>Forward</button>
                        </form>

                        <form action="{{ url('mails/'.$mail->id) }}" method="post" style="display: inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button class="btn btn-sm tooltips"  type="submit"><i class="fa fa-trash-o"></i></button>
                        </form>

                    </div>
                @endcan
            </div>
        </section>
@endsection