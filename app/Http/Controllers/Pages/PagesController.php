<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;

class PagesController
{
    public function index()
    {
        return view('pages.index');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }
}
