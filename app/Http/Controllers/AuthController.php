<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // login form
    public function login()
    {
        return view("auth.login");
    }
}
