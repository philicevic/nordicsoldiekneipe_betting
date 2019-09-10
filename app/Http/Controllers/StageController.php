<?php

namespace App\Http\Controllers;

use App\Stage;
use App\BettingGame;
use Illuminate\Http\Request;

class StageController extends Controller
{
    public function create(BettingGame $game) {
        return view('betting.createStage', compact('game'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $validatedData['betting_game_id'] = BettingGame::where('slug', $request->game)->first()->id;
        Stage::create($validatedData);
        return redirect(route('betting.gameAdmin', $request->game));
    }
}
