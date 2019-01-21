@extends('template.index')

@section('title', 'Account')

@section('content')

<a href="{{ route('game.start') }}" class="btn btn-lg btn-dark">Zagraj</a>
{{--<a href="{{ route('game') }}" class="btn btn-lg btn-secondary">Twoje rozgrywki</a>--}}

    Your Games:
@foreach($games as $game)

    <div class="row mt-4">
        <div class="col">
            ID: {{ $game->id }}
        </div>
        <div class="col">
            <a href="{{ route('game.game', $game) }}" class="btn btn-lg btn-dark">Zagraj</a>
        </div>
    </div>
@endforeach
@stop
