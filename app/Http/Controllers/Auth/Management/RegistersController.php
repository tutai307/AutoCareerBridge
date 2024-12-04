<?php

namespace App\Http\Controllers\Auth\Management;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        if (auth('admin')->check()) {
            return redirect()->back();
        }
        return view('management.auth.register');
    }

    public function postResgister(RegisterRequest $request)
    {
        try {
            $this->authService->register($request);

            return redirect()->route('management.login')->with('status_success', 'Vui lòng check mail để xác thực tài khoản');
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . ' ---Line: ' . $e->getLine());
            return back()->with('status_fail', 'Đăng ký thất bại, vui lòng thử lại sau');
        }
    }

    public function confirmMailRegister(Request $request)
    {
        if (!empty($request->token)) {
            $user =  $this->authService->confirmMailRegister($request->token);
            if (empty($user)) {
                return redirect()->route('management.login')->with('status_fail', 'Quá thời gian đổi mật khẩu !');
            }

            return redirect()->route('management.login')->with('status_success', 'Đã xác thực email thành công !');
        }
    }
}
