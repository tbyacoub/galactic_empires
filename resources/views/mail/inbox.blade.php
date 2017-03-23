@extends('mail.layout')

@section('mail-content')
    <section class="panel">
        <header class="panel-heading wht-bg">
            <h4 class="gen-case">Inbox ({{ Auth::user()->unReadMail()->count() }})</h4>
        </header>
        <div class="panel-body minimal">

            <inbox :mails="{{$items}}"></inbox>

            {{ $mails->links() }}

        </div>
    </section>
@endsection