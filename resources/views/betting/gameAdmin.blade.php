@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>{{ $game->name }}</h1>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Stages</div>
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
                                <tr>
                                    <td>MIBR</td>
                                    <td>vs.</td>
                                    <td>NiP</td>
                                    <td>28.08.2019 13:00</td>
                                    <td>New Legend Stage</td>
                                </tr>
                                <tr>
                                    <td>Team Liquid</td>
                                    <td>vs.</td>
                                    <td>Dreameaters</td>
                                    <td>28.08.2019 12:00</td>
                                    <td>New Legend Stage</td>
                                </tr>
                                <tr>
                                    <td>Ence</td>
                                    <td>vs.</td>
                                    <td>AVANGAR</td>
                                    <td>28.08.2019 12:00</td>
                                    <td>New Legend Stage</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Matches</div>
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
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
