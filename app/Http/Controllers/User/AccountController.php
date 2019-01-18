<?php

namespace App\Http\Controllers\User;

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
        return $this->view('account');
    }
}
