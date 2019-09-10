@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
        <h1>
            {{ $match->team1->name }} vs. {{ $match->team2->name }} ({{ $match->stage->name }})
        </h1>
        </div>
        <div class="col-md-12">
            <div class="card matchcard">
                <div class="card-header">Match</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('betting.match.saveBet', ['game' => $game, 'match' => $match]) }}">
                        @csrf
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5 team-column">
                                <h2>{{$match->team1->shortname}}</h2>
                                <div class="logo">
                                    <img src="{{ $match->team1->logo }}" height="200px">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="col-xs-6 col-xs-offset-3">
                                        <input class="form-control form-control-lg" type="text" name="score_team1" value="{{ $bet ? $bet->score_team1 : ''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 center-column">
                                <h2>vs.</h2>
                                <h4>{{ $match->type }}</h4>
                                <h5>{{ $match->time->format('d.m.Y H:i') }}</h5>
                                <p class="save">
                                </p>
                                <p>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <input type="submit" class="btn btn-primary" value="Speichern">
                                        <a href="{{ route('betting.show', $game) }}" class="btn btn-danger">Zurück</a>
                                    </div>
                                </p>
                            </div>
                            <div class="col-md-5 team-column">
                                <h2>{{$match->team2->shortname}}</h2>
                                <div class="logo">
                                    <img src="{{ $match->team2->logo }}" height="200px">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="col-xs-6 col-xs-offset-3">
                                        <input class="form-control form-control-lg" type="text" name="score_team2" value="{{ $bet ? $bet->score_team2 : ''}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
