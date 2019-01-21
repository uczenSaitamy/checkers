<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'game';
    protected $fillable = ['id', 'status', 'user_id', 'area_id'];

    public function area()
    {
        return $this->hasOne(Area::class);
    }
}
