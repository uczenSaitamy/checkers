<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
//    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $prefix = null;

    public function __construct()
    {
//
    }

    protected function view($view, $data = [])
    {
        if(isset($this->prefix) && $this->prefix !== null) {
            $view = sprintf("%s.%s", $this->prefix, $view);
        }

        return view($view, $data);
    }
}
