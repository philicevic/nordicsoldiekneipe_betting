<?php

namespace App;

use App\BettingGame;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public function bettingGame() {
        return $this->belongsTo(BettingGame::class);
    }
}
