@extends('template.index')

@section('title', 'Account')

@section('content')

    <a href="{{ route('game.start') }}" class="btn btn-lg btn-dark">Play New Game</a>
    {{--<a href="{{ route('game') }}" class="btn btn-lg btn-secondary">Twoje rozgrywki</a>--}}

    @foreach($games as $game)
        <div class="row mt-4">
            <div class="col">
                <div class="row h2">
                    Your Games:
                </div>
                <div class="row">
                    <div class="col">
                        ID: {{ $game->id }}
                    </div>
                    <div class="col">
                        <a href="{{ route('game.game', $game) }}" class="btn btn-lg btn-dark">Finish</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row mt-4">
        <div class="col">
            <div class="row mt-4 h2">
                Your Statistics:
            </div>
            <div class="row">
                <div class="col h3">
                    Wins: {{ $win }}
                </div>
                <div class="col h3">
                    Losts: {{ $lost }}
                </div>
            </div>
        </div>
    </div>
@stop
