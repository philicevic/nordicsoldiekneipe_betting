@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Neues Team anlegen</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('betting.storeMatch', $game) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="ruleset" class="col-md-4 col-form-label text-md-right">{{ __('Stage') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control @error('stage_id') is-invalid @enderror" name="stage_id" id="stage_id">
                                        @foreach ($game->stages as $stage)
                                            <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('stage_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ruleset" class="col-md-4 col-form-label text-md-right">{{ __('Team 1') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control @error('team_1') is-invalid @enderror" name="team_1" id="team_1">
                                        @foreach ($game->teams as $team)
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('team_1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ruleset" class="col-md-4 col-form-label text-md-right">{{ __('Team 2') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control @error('team_2') is-invalid @enderror" name="team_2" id="team_2">
                                        @foreach ($game->teams as $team)
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('team_2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">


                                <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('Zeitpunkt') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                                            <input id="time" data-target="#datetimepicker" type="text" class="form-control datetimepicker-input @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" required>
                                        <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                        </div>
                                    </div>


                                    @error('time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Typ') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control @error('type') is-invalid @enderror" name="type" id="type">
                                        <option value="Best Of 1">Best Of 1</option>
                                        <option value="Best Of 2">Best Of 2</option>
                                        <option value="Best Of 3">Best Of 3</option>
                                        <option value="Best Of 5">Best Of 5</option>
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Anlegen') }}
                                    </button>
                                </div>
                            </div>
                            @if($errors)
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            @endif
                            <script>
                                $('.datetimepicker').datetimepicker({
                                    format: 'LT'
                                });
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
