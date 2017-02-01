@extends('layout')

@section('content')

    <h1>All Cards</h1>

    @foreach ($cards as $card)
    	<div>
    		
    		<a href="/cards/{{ $card->id }}">{{ $card->title}}</a>

    	</div>

    @endforeach
@stop