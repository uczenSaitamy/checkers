<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $prefix = 'home';

    public function index()
    {
        return $this->view('index');
    }
}
