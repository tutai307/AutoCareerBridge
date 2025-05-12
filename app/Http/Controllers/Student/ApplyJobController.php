<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplyJobController extends Controller
{
    public function applyJob(Request $request)
    {
        // Kiểm tra xem sinh viên đã đăng nhập chưa
        if (!auth()->guard('student')->check()) {
            return redirect()->route('home.showLoginForm')
                ->with('status_error', 'Vui lòng đăng nhập để ứng tuyển');
        }

        // Lấy thông tin sinh viên đang đăng nhập
        $student = auth()->guard('student')->user();

        // Kiểm tra xem sinh viên đã ứng tuyển công việc này chưa
        $existingApplication = \App\Models\Application::where('student_id', $student->id)
            ->where('job_id', $request->job_id)
            ->first();

        if ($existingApplication) {
            return back()->with('status_error', 'Bạn đã ứng tuyển công việc này rồi');
        }

        // Tạo bản ghi mới trong bảng applications
        $application = new \App\Models\Application();
        $application->student_id = $student->id;
        $application->job_id = $request->job_id;
        $application->resume_id = $request->resume_id;
        $application->cover_letter = $request->cover_letter;
        $application->status = 'pending';
        $application->save();

        return back()->with('status_success', 'Ứng tuyển thành công! Nhà tuyển dụng sẽ sớm liên hệ với bạn.');
    }
}
