<?php

namespace App\Models\Game;

use App\Models\Model;
use App\Models\User;

class Game extends Model
{
    protected $table = 'game';
    protected $fillable = ['id', 'status', 'user_id', 'area_id'];

    public function area()
    {
        return $this->hasOne(Area::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
