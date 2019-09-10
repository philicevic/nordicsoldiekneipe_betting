<?php

namespace App;

use App\BettingGame;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'shortname', 'logo', 'betting_game_id'];

    public function bettingGame() {
        return $this->belongsTo(BettingGame::class);
    }
}
