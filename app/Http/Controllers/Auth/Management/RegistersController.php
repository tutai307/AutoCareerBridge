<?php

namespace App\Http\Controllers\Auth\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Services\Managements\AuthService;
use App\Http\Requests\Auth\RegisterRequest;

class RegistersController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function viewResgister()
    {
        return view('management.auth.register');
    }

    public function postResgister(RegisterRequest $request)
    {
        $data = $request->all();
        $this->authService->register($data);

        return redirect()->route('management.login')->with('status_success', 'Vui lòng check mail để xác thực tài khoản');
    }

    public function confirmMailRegister(Request $request)
    {
        if (!empty($request->token)) {
            $user =  $this->authService->confirmMailRegister($request->token);
            if (empty($user)) {
                return redirect()->route('management.login')->with('status_fail', 'Token không hợp lệ');
            }

            return redirect()->route('management.login')->with('status_success', 'Đã xác thực email thành công vui lòng chờ quản trị duyệt tài khoản rồi đăng nhập !');
        }
    }
}
