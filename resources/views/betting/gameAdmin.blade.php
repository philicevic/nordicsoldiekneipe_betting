@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>
                    {{ $game->name }}
                <a href="{{ route('betting.show', $game->slug) }}" class="btn btn-success">Overview</a>
                </h1>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Matches</div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Zeitpunkt</th>
                                    <th>Stage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($matches as $match)
                                    <tr>
                                        <td>{{ $match->team1->name }}</td>
                                        <td>vs.</td>
                                        <td>{{ $match->team2->name }}</td>
                                        <td>{{ $match->time->format('d.m.Y H:i') }}</td>
                                        <td>{{ $match->stage->name }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Keine Matches gefunden</td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="5"><a href="{{ route('betting.createMatch', [$game]) }}">Neues Match anlegen</a></td>
                                </tr>
                            </tbody>
                        </table>
                        {{ $matches->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Stages</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Matches</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($game->stages as $stage)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $stage->name }}</td>
                                        <td>{{ count($stage->matches) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td></td>
                                        <td>Keine Stages vorhanden</td>
                                        <td></td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td></td>
                                    <td><a href="{{ route('betting.createStage', $game) }}">Neue Stage anlegen</a></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Teams</div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                @forelse ($teams as $team)
                                    <tr>
                                        <th scope="row"><img src="{{ $team->logo }}" height="24px"></th>
                                        <td>{{ $team->shortname }}</td>
                                    </tr>
                                @empty
                                    <tr><td>No teams found</td></tr>
                                @endforelse
                                <tr>
                                    <td></td>
                                    <td><a href="{{ route('betting.createTeam', ['game' => $game]) }}">Neues Team anlegen</a></td>
                                </tr>
                            </tbody>
                        </table>
                        {{ $teams->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
