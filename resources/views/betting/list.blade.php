@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tippspiele') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($games as $game)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $game->name }}</td>
                                    <td><a href="{{ route('betting.show', ['game' => $game->slug]) }}"><span class="badge badge-success">Gestartet</span></a></td>
                                </tr>
                            @empty
                                <tr><td></td><td>No games found</td></tr>
                            @endforelse
                        </tbody>
                        @if (Auth::user()->admin)
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td><a href="{{ route('betting.createGame') }}">Neues Spiel starten</a></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        @endif
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
