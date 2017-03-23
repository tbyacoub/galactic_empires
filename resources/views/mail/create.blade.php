@extends('mail.layout')

@section('mail-content')
    @if($errors->has('email'))
        <div class="alert alert-danger"><b>Oh snap! </b>{{$errors->first('email')}}</div>
    @elseif($errors->has('subject'))
        <div class="alert alert-danger"><b>Oh snap! </b>{{$errors->first('subject')}}</div>
    @elseif($errors->has('message'))
        <div class="alert alert-danger"><b>Oh snap! </b>{{$errors->first('message')}}</div>
    @endif
    <section class="panel">
        <header class="panel-heading wht-bg">
            <h4 class="gen-case"> Compose Mail</h4>
        </header>
        <div class="panel-body">
            <div class="compose-mail">
                <form role="form-horizontal" method="POST" action="{{ url('/mails') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email" class="">To:</label>
                        @if($errors->has('email') || $errors->has('subject') || $errors->has('message'))
                            <input type="email" tabindex="1" id="email" name="email" class="form-control" value="{{ old('email') }}">
                        @else
                            <input type="email" tabindex="1" id="email" name="email" class="form-control" value="{{ session('email') }}">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="subject" class="">Subject:</label>
                        <input type="text" tabindex="1" id="subject" name="subject" class="form-control" value="{{ old('subject') }}">
                    </div>

                    <div class="compose-editor">
                        @if($errors->has('email') || $errors->has('subject') || $errors->has('message'))
                            <textarea maxlength="500" class="wysihtml5 form-control" id="message" name="message" rows="9">{{ old('message') }}</textarea>
                        @else
                            <textarea maxlength="500" class="wysihtml5 form-control" id="message" name="message" rows="9">{{ session('message') }}</textarea>
                        @endif
                    </div>
                    <div class="compose-btn">
                        <button type="submit" class="btn btn-theme btn-sm"><i class="fa fa-check"></i>Send</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection