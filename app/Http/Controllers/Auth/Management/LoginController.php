<?php

namespace App\Http\Controllers\Auth\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function viewLogin()
    {
        return view('management.auth.login');
    }
}
