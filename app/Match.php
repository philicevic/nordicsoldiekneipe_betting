<?php

namespace App;

use App\Bet;
use App\Team;
use App\Stage;
use App\BettingGame;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = ['stage_id', 'team_1', 'team_2', 'time', 'type'];

    public function getTimeAttribute($value) {
        $value = \Carbon\Carbon::parse($value);
        return $value;
    }

    public function stage() {
        return $this->belongsTo(Stage::class);
    }

    public function team1() {
        return $this->belongsTo(Team::class, 'team_1');
    }

    public function team2() {
        return $this->belongsTo(Team::class, 'team_2');
    }

    public function bets() {
        return $this->hasMany(Bet::class);
    }
}
