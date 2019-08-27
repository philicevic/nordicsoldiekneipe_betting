<?php

namespace App\Http\Controllers;

use App\Team;
use App\BettingGame;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class BettingController extends Controller
{
    use UploadTrait;

    public function list() {
        $games = BettingGame::all();
        return view('betting.list', ['games' => $games]);
    }

    public function show(BettingGame $game) {
        return view('betting.show', ['game' => $game]);
    }

    public function showMatch(BettingGame $game) {
        return view('betting.show', ['game' => $game]);
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
        $teams = Team::where('betting_game', $game->id)->get();
        return view('betting.gameAdmin', compact('game', 'teams'));
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

        $validatedData['betting_game'] = BettingGame::where('slug', $request->game)->first()->id;

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
}
