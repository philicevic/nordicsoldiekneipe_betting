<?php

namespace App;

use App\Match;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $fillable = [
        'score_team1',
        'score_team2',
        'user_id',
        'match_id'
    ];

    public function match() {
        return $this->belongsTo(Match::class);
    }
}
