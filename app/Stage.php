<?php

namespace App;

use App\Match;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;

class Stage extends Model
{
    use SortableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'betting_game_id', 'sorting'];

    public $sortable = [
        'order_column_name' => 'sorting',
        'sort_when_creating' => true,
    ];

    public function bettingGame() {
        return $this->belongsTo(BettingGame::class);
    }

    public function matches() {
        return $this->hasMany(Match::class);
    }
}
