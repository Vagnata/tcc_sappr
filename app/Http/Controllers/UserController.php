<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function showLogin()
    {
        return view('user/login');
    }

    public function showRegister()
    {
        return view('user/register');
    }
}
