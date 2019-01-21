<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\StoreUser;
use App\Http\Requests\ValidateUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $prefix = 'auth';
    protected $guard;

    public function __construct()
    {
        $this->guard = Auth::guard('user');
    }

    public function register()
    {
        return $this->view('register');
    }

    public function store(StoreUser $storeUser)
    {
        $user = new User();
        $user->fill($storeUser->only($user->getFillable()));
        if ($user->save()) {
            return redirect()->back()->withSuccess('Registration has been completed. You can login now');
        }
        return redirect()->back()->withErrors('Unexpected errors occurred. Please check the correctness of the data');
    }

    public function login()
    {
        return $this->view('login');
    }

    public function authorize(ValidateUser $validateUser)
    {
        if (!User::findByEmail($validateUser->email)) {
            return redirect()->back()->withErrors('Incorrect data entered');
        }
        $credentials = $validateUser->only('email', 'password');
        if ($this->guard->attempt($credentials)) {
            return redirect()->route('user.account')->withSuccess('Successfully logged in');
        }
        return redirect()->back()->withErrors('Incorrect data entered');
    }

    public function logout()
    {
        if ($this->guard->user()) {
            Auth::guard('user')->logout();
        }
        return redirect()->route('home')->withSuccess('Successfull logout');
    }
}
