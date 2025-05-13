<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Resume;
use App\Services\Job\JobService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ManageCVController extends Controller
{
    protected $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }


    public function index()
    {
        if (Auth::guard('student')->check()) {
            // Lấy danh sách việc làm có hợp tác với trường
            $university_id = Auth::guard('student')->user()->university_id;
            $recommendedJobs = $this->jobService->getAppliedJobs($university_id);
            $student = Auth::guard('student')->user();
            $suitableJobs = $this->jobService->getSuitableJobs($student);
        } else {
            $recommendedJobs = [];
            $suitableJobs = [];
        }
        $applications = Application::where('student_id', $student->id)->get();
        // dd($applications);
        $resumes = Resume::where('student_id', $student->id)->get();
        return view('home.pages.manageCV', compact('suitableJobs', 'recommendedJobs', 'resumes', 'applications'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'cv_file' => 'required|mimes:pdf,doc,docx|max:2048',
                'title' => 'required|string|max:255'
            ], [
                'cv_file.required' => 'Vui lòng chọn file CV',
                'cv_file.mimes' => 'File CV phải có định dạng pdf, doc hoặc docx',
                'cv_file.max' => 'File CV không được vượt quá 2MB',
                'title.required' => 'Vui lòng nhập tiêu đề CV',
                'title.string' => 'Tiêu đề CV phải là chuỗi ký tự',
                'title.max' => 'Tiêu đề CV không được vượt quá 255 ký tự'
            ]);

            $student = Auth::guard('student')->user();
            $resume = new Resume();
            $resume->student_id = $student->id;
            $resume->title = $request->title;

            // Lấy phần mở rộng của file gốc
            $extension = $request->cv_file->getClientOriginalExtension();

            // Tạo tên file mới từ title và phần mở rộng
            $filename = Str::slug($request->title) . '.' . $extension;

            // Lưu file với tên mới
            $resume->file_path = $request->cv_file->storeAs('resumes', $filename, 'public');
            $resume->save();

            return redirect()->route('home.manageCV')->with('status_success', 'CV đã được lưu thành công');

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Illuminate\Support\Facades\Log::error('Lỗi xác thực khi lưu CV: ' . json_encode($e->errors()));
            $errors = $e->errors();
            $errorMessage = '';
            foreach($errors as $field => $messages) {
                if($field == 'cv_file') {
                    $errorMessage .= 'File CV: ' . $messages[0] . '. ';
                }
                if($field == 'title') {
                    $errorMessage .= 'Tiêu đề: ' . $messages[0] . '. ';
                }
            }
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('status_fail', $errorMessage ?: 'Vui lòng kiểm tra lại thông tin');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Lỗi khi lưu CV: Dòng ' . $e->getLine() . ' - ' . $e->getMessage());
            return redirect()->back()
                ->with('status_fail', 'Đã xảy ra lỗi khi lưu CV. Vui lòng thử lại sau hoặc liên hệ quản trị viên.')
                ->withInput();
        }
    }

    public function setMain(Request $request)
    {
            $resume = Resume::find($request->resume_id);

            if (!$resume) {
                return back()->with('status_error', 'Không tìm thấy CV');
            }


            // Bỏ đánh dấu CV chính cũ
            Resume::where('student_id', auth()->id())
                  ->update(['is_main' => false]);

            // Gán lại CV chính
            Resume::where('student_id', $resume->student_id)
                  ->where('id', '!=', $resume->id)
                  ->update(['is_main' => false]);
            $resume->is_main = true;
            $resume->save();

            return redirect()->route('home.manageCV')
                   ->with('status_success', 'Đặt làm CV chính thành công!');
    }

    public function edit(Request $request)
    {
        $resume = Resume::find($request->resume_id);
        $resume->title = $request->title;
        $resume->save();

        return redirect()->route('home.manageCV')->with('status_success', 'Tên CV đã được cập nhật thành công');
    }

    public function delete(Request $request)
    {
        $resume = Resume::find($request->resume_id);
        $resume->delete();

        return redirect()->route('home.manageCV')->with('status_success', 'CV đã được xóa thành công');
    }
}
