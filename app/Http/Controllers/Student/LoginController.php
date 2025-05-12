<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest:students')->except('logout');
    // }

    public function index()
    {
        return view('home.index');
    }

    public function showLoginForm()
    {
        return view('home.pages.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'student_code' => 'required',
            'password' => 'required',
        ]);

        $student = Student::where('student_code', $request->student_code)->first();

        if (!$student) {
            return redirect()->back()->withErrors(['student_code' => 'Mã sinh viên không tồn tại']);
        }

        // Nếu mật khẩu đã được thay đổi (khác null), chỉ kiểm tra mật khẩu đã hash
        if ($student->password) {
            if (!Hash::check($request->password, $student->password)) {
                return redirect()->back()->withErrors(['password' => 'Mật khẩu không chính xác']);
            }
        }
        // Nếu chưa đổi mật khẩu (password là null), cho phép dùng mật khẩu mặc định
        else if ($request->password !== ($student->student_code . '@')) {
            return redirect()->back()->withErrors(['password' => 'Mật khẩu không chính xác']);
        }

        Auth::guard('student')->login($student);
        return redirect()->route('home.index')->with(['status_success' => 'Đăng nhập thành công']);
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('home.index');
    }

    public function forgotPassword()
    {
        return redirect()->back()->with(['info' => 'Vui lòng liên hệ nhà trường hoặc GVHD để lấy lại mật khẩu']);

    }
}