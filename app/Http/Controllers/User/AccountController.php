<?php

namespace App\Http\Controllers\User;

use App\Models\Game\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    protected $prefix = 'account';
    protected $guard;

    public function __construct()
    {
        $this->guard = Auth::guard('user');
    }

    public function account()
    {
        $games = $this->guard->user()->games->where('status', '=', 'running');
        $win = $this->guard->user()->games->where('status', '=', 'win')->count();
        $lost = $this->guard->user()->games->where('status', '=', 'lost')->count();
        return $this->view('account', compact(['games', 'win', 'lost']));
    }
}
