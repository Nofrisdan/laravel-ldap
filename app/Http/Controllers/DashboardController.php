<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // index
    public function index()
    {
        // // return "ok";
        // echo "Halaman Dashboard";
        // dd(Auth::check(), Auth::user(), session()->all());

        // dd(Auth::user()->name);
        $hasil = "UserID :  " . Auth::user()->id . "| Name : " . Auth::user()->name;
        return $hasil;
    }
}
