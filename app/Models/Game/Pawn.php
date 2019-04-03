<?php

namespace App\Models\Game;

use App\Models\Model;

class Pawn extends Model
{
    protected $table = 'pawn';
    protected $fillable = ['id', 'type', 'color', 'x', 'y', 'area_id'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
