<?php

namespace App\Http\Controllers;

use Auth;
use App\Bet;
use App\Team;
use App\Match;
use Carbon\Carbon;
use App\BettingGame;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class BettingController extends Controller
{
    use UploadTrait;

    public function list() {
        $games = BettingGame::all();
        return view('betting.list', ['games' => $games]);
    }

    public function show(BettingGame $game) {
        $matches = Match::whereHas('stage', function (Builder $query) use ($game) {
            $query->where('betting_game_id', $game->id);
        })->where('time', '>', Carbon::now())->oldest('time')->get();
        return view('betting.show', compact('game', 'matches'));
    }

    public function showMatch(BettingGame $game, Match $match) {
        $bet = Bet::where([
            ['match_id', '=', $match->id],
            ['user_id', '=', Auth::user()->id]
        ])->get()->first();
        return view('betting.match', compact('game', 'match', 'bet'));
    }

    public function saveBet(BettingGame $game, Match $match) {
        $bet = Bet::where([
            ['match_id', '=', $match->id],
            ['user_id', '=', Auth::user()->id]
        ])->get()->first();
        if ($bet) {
            $bet->score_team1 = request('score_team1');
            $bet->score_team2 = request('score_team2');
            $bet->save();
        } else {
            $validatedData = request()->validate([
                'score_team1' => 'required|integer',
                'score_team2' => 'required|integer'
            ]);
            $validatedData['match_id'] = $match->id;
            $validatedData['user_id'] = Auth::user()->id;

            $bet = Bet::create($validatedData);
        }
        return redirect(route('betting.match', compact('game', 'match')));
    }

    public function createGame() {
        return view('betting.createGame');
    }

    public function storeGame(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'ruleset' => 'required'
        ]);
        $game = BettingGame::create($validatedData);
        return redirect(route('betting.show', ['game' => $game]));
    }

    public function gameAdmin(BettingGame $game) {
        $matches = Match::whereHas('stage', function (Builder $query) use ($game) {
            $query->where('betting_game_id', $game->id);
        })->oldest('time')->paginate(10, ['*'], 'matches');
        $teams = $game->teams()->paginate(10, ['*'], 'teams');
        return view('betting.gameAdmin', compact('game', 'teams', 'matches'));
    }

    public function createTeam(BettingGame $game) {
        return view('betting.createTeam', compact('game'));
    }

    public function storeTeam(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
            'shortname' => 'required|max:12',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $validatedData['betting_game_id'] = BettingGame::where('slug', $request->game)->first()->id;

        $team = Team::create($validatedData);

        if ($request->has('logo')) {
            $image = $request->file('logo');
            // Make a image name based on user name and current timestamp
            $name = str_slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);

            $team->logo = $filePath;
        }

        $team->save();

        return redirect(route('betting.gameAdmin', ['game' => $request->game]));
    }

    public function createMatch(BettingGame $game) {
        return view('betting.createMatch', compact('game'));
    }

    public function storeMatch(Request $request) {
        $validatedData = $request->validate([
            'stage_id' => 'required|exists:stages,id',
            'team_1' => 'required|different:team_2',
            'team_2' => 'required|different:team_1',
            'type' => 'string|in:Best Of 1,Best Of 2,Best Of 3,Best Of 5',
            'time' => 'date|after:now'
        ]);
        $validatedData['time'] = Carbon::parse($validatedData['time']);
        $match = Match::create($validatedData);
        return redirect(route('betting.gameAdmin', $request->game));
    }
}
