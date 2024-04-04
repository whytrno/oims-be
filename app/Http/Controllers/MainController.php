<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
}
