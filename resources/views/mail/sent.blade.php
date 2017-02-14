@extends('mail.layout')

@section('mail-content')
    <section class="panel">
        <header class="panel-heading wht-bg">
            <h4 class="gen-case">Sent Mail
                <form action="#" class="pull-right mail-src-position">
                    <div class="input-append">
                        <input type="text" class="form-control " placeholder="Search Mail">
                    </div>
                </form>
            </h4>
        </header>
        <div class="panel-body minimal">

            <div class="table-inbox-wrap ">
                <table class="table table-inbox table-hover">
                    <tbody>
                    @foreach($mails as $mail)
                        <tr>
                            <td class="inbox-small-cells"></td>
                            <td class="inbox-small-cells"></td>
                            <td class="view-message dont-show">
                                <a href="#">{{$mail->receiver->name}}</a>
                            </td>
                            <td class="view-message"><a href="#">{{$mail->subject}}</a></td>
                            <td class="view-message text-right">{{$mail->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{ $mails->links() }}

        </div>
    </section>
@endsection