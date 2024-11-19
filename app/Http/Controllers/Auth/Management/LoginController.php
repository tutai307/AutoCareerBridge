<?php

namespace App\Http\Controllers\Auth\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Managements\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        
        if ($user->role === ROLE_ADMIN || $user->role === ROLE_SUB_ADMIN) {
            return redirect()->route('admin.home')->with('success', __('message.login_success'));

        } elseif ($user->role === ROLE_COMPANY) {
            if (empty($user->company )) {
                return redirect()->route('company.profileUpdate', ['slug' => $user->id])->with('error', 'Vui lòng cập nhật thông tin doanh nghiệp !');
            } else {
                return redirect()->route('company.home')->with('status_success', 'Đăng nhập thành công');
            }

        } elseif ($user->role === ROLE_UNIVERSITY || $user->role === ROLE_SUB_UNIVERSITY) {
            return redirect()->route('university.home')->with('success', __('message.login_success'));
        } elseif ($user->role === ROLE_HIRING) {
            return redirect()->route('company.home')->with('success', __('message.login_success'));
        }
    
}

    public function viewForgotPassword()
    {
        return view('management.auth.forgotPassword');
    }

    public function checkForgotPassword(Request $request)
    {
        try {
            $this->authService->checkForgotPassword($request);
            return redirect()->route('management.login')->with('status_success', 'Vui lòng kiểm tra email đổi mật khẩu !');
        } catch (\Exception $e) {
            Log::error('Error in checkForgotPassword: ' . $e->getMessage());
            return back()->with('status_fail', 'Đã xảy ra lỗi, vui lòng thử lại.');
        }
    }

    public function viewChangePassword(Request $request)
    {
        $user = $this->authService->confirmMailChangePassword($request->token);
        if (empty($user)) {
            return redirect()->route('management.login')->with('status_fail', 'Đổi mật khẩu thất bại !');
        }
        return view('management.auth.changePassword');
    }

    public function postPassword(ForgotPasswordRequest $request)
    {
        try {
            $user = $this->authService->postPassword($request);
            if ($user) {
                return redirect()->route('management.login')->with('status_success', 'Đổi mật khẩu thành công !');
            }
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . ' ---Line: ' . $e->getLine());
            return redirect()->route('management.login')->with('status_fail', 'Đổi mật khẩu thất bại !');
        }
    }

    public function logout($id)
    {
        $user = $this->authService->logout($id);
        if(empty($user)) {
            return redirect()->back();
        }
        return redirect()->route('management.login');
    }
}
