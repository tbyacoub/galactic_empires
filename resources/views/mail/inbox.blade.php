@extends('mail.layout')

@section('mail-content')
    <section class="panel">
        <header class="panel-heading wht-bg">
            <h4 class="gen-case">Inbox ({{ Auth::user()->unReadMail()->count() }})
                <form action="#" class="pull-right mail-src-position">
                    <div class="input-append">
                        <input type="text" class="form-control " placeholder="Search Mail">
                    </div>
                </form>
            </h4>
        </header>
        <div class="panel-body minimal">

            <inbox :mails="{{$items}}"></inbox>

            {{ $mails->links() }}

        </div>
    </section>
@endsection