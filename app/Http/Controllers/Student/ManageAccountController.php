<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class ManageAccountController extends Controller
{
    public function index()
    {
        return view('home.pages.manageAccount');
    }

    /**
     * Cập nhật thông tin cá nhân của sinh viên.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $student = Auth::guard('student')->user();

        $validated = $request->validate([
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('students')->ignore($student->id),
            ],
            'phone' => ['nullable', 'string', 'max:20'], // Điều chỉnh quy tắc validation nếu cần
        ]);

        $student->email = $validated['email'];
        $student->phone = $validated['phone'];
        $student->save();

        return redirect()->back()->with('status_success', 'Cập nhật thông tin cá nhân thành công.');
    }

    /**
     * Cập nhật mật khẩu của sinh viên.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $student = Auth::guard('student')->user();

        try {
            $validated = $request->validate([
                'current_password' => ['required', 'current_password:student'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('status_fail', 'Vui lòng kiểm tra lại thông tin:');
        }

        try {
            $student->password = Hash::make($validated['password']);
            $student->save();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('status_fail', 'Có lỗi xảy ra khi cập nhật mật khẩu. Vui lòng thử lại sau.');
        }

        return redirect()->back()->with('status_success', 'Đổi mật khẩu thành công.');
    }

    public function updateAvatar(Request $request)
    {
        $student = Auth::guard('student')->user();

        $validated = $request->validate([
            'avatar' => ['required', 'image', 'max:2048']
        ]);

        if ($request->hasFile('avatar')) {
            // Xóa avatar cũ nếu có
            if ($student->avatar_path) {
                Storage::disk('public')->delete($student->avatar_path);
            }

            // Lưu avatar mới
            $avatarPath = $request->file('avatar')->store('student', 'public');
            $student->avatar_path = $avatarPath;
            $student->save();

            return response()->json([
                'success' => true,
                'avatar_url' => asset('storage/' . $avatarPath)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không tìm thấy file ảnh'
        ]);
    }
}
