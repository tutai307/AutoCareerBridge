<?php

namespace App\Http\Controllers\Auth\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Managements\AuthService;

class LoginController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function viewLogin()
    {
        return view('management.auth.login');
    }

    public function checkLogin(LoginRequest $request)
    {
        $data = $request->all();
        $user =  $this->authService->login($data);

        if (empty($user)) {
            return back()->withInput()->with('error', 'Email hoặc tài khoản và mật khẩu không chính xác !');
        }

        if ($user->role === ROLE_ADMIN) {
            dd("Admin");
            // return redirect()->route(route: 'management.home')->with('success', 'Đăng nhập thành công');
        } elseif ($user->role === ROLE_COMPANY) {
            dd("Company");
            // return redirect()->route('management.home')->with('success', 'Đăng nhập thành công');
        } elseif ($user->role === ROLE_UNIVERSITY) {
            dd("University");
            // return redirect()->route('management.home')->with('success', 'Đăng nhập thành công');
        } elseif ($user->role === ROLE_HIRING) {
            dd("Hiring");
            // return redirect()->route('management.home')->with('success', 'Đăng nhập thành công');
        }
    }
}
