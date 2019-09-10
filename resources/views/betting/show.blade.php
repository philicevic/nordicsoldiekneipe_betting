@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
            <h1>
                {{ $game->name }}
                @if (Auth::user()->admin)
                    <a href="{{ route('betting.gameAdmin', $game->slug) }}" class="btn btn-success">Admin</a>
                @endif
            </h1>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Nächste Matches</div>
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
                                <tr onclick="window.location='{{ route('betting.match', ['game' => $game, 'match' => $match]) }}';">
                                    <td>{{ $match->team1->name }}</td>
                                    <td>vs.</td>
                                    <td>{{ $match->team2->name }}</td>
                                    <td>{{ $match->time->diffForHumans(\Carbon\Carbon::now(), ['syntax' => \Carbon\CarbonInterface::DIFF_RELATIVE_TO_NOW]) }}</td>
                                    <td>{{ $match->stage->name }}</td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">Keine Matches gefunden</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Leaderboard</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Punkte</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Dedgrad21</td>
                                    <td>47</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>xqsp4m</td>
                                    <td>40</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Zaser</td>
                                    <td>32</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
