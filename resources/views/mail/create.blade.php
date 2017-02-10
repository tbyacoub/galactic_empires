@extends('mail.layout')

@section('mail-content')
    <section class="panel">
        <header class="panel-heading wht-bg">
            <h4 class="gen-case"> Compose Mail
                <form action="#" class="pull-right mail-src-position">
                    <div class="input-append">
                        <input type="text" class="form-control " placeholder="Search Mail">
                    </div>
                </form>
            </h4>
        </header>
        <div class="panel-body">
            <div class="compose-mail">
                <form role="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="to" class="">To:</label>
                        <input type="text" tabindex="1" id="to" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="subject" class="">Subject:</label>
                        <input type="text" tabindex="1" id="subject" class="form-control">
                    </div>

                    <div class="compose-editor">
                        <textarea class="wysihtml5 form-control" rows="9"></textarea>
                        <input type="file" class="default">
                    </div>
                    <div class="compose-btn">
                        <button class="btn btn-theme btn-sm"><i class="fa fa-check"></i> Send</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection