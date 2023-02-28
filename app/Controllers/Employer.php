<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Employer extends BaseController
{
    public function index()
    {
        //
        return view('employer/dashboard');
    }
}