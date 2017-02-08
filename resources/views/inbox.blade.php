@extends('layouts.dashboard')

@section('sub-content')
<div class="row mt">
    <div class="content-panel">
        <h4><i class="fa fa-angle-right"></i>Inbox</h4>
        <section id="no-more-tables">
            <table class="table table-bordered table-striped table-condensed cf">
                <thead class="cf">
                <tr>
                    <th>sender</th>
                    <th>subject</th>
                    <th class="numeric">date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td data-title="Code">{{ $message->sender->name }}</td>
                        <td data-title="Company"><a href="#">{{ $message->subject }}</a></td>
                        <td class="numeric" data-title="Price">{{ $message->created_at }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </section>
    </div><!-- /content-panel -->
</div><!-- /row -->

@endsection