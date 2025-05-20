<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Services\Job\JobService;
use App\Services\Major\MajorService;
use App\Services\Skill\SkillService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Application;
use App\Models\Job;
use App\Models\Resume;
use Illuminate\Validation\Rule;
use App\Models\StudentNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use OpenAI\Laravel\Facades\OpenAI;
use Smalot\PdfParser\Parser;

class ResumesController extends Controller
{
    protected $jobService;
    protected $skillService;
    protected $majorService;

    public function __construct(JobService $jobService, SkillService $skillService, MajorService $majorService)
    {
        $this->jobService = $jobService;
        $this->skillService = $skillService;
        $this->majorService = $majorService;
    }
    public function index(Request $request)
    {
        $data = $request->only(['search', 'status', 'major']);
        $jobs = $this->jobService->getPostsByCompany($data);
        $majors = $this->majorService->getAll();
        return view('management.pages.company.resume.index', compact('jobs', 'majors'));
    }

    public function show($job_id)
    {
        try {
            $applicants = $this->jobService->getApplicantsByJobId($job_id);
            $pending = $applicants['pending'];
            $suitable = $applicants['suitable'];
            $notSuitable = $applicants['notSuitable'];
            return view('management.pages.company.resume.list', compact('pending', 'suitable', 'notSuitable'));
        } catch (\Exception $exception) {
            Log::error('Lỗi : ' . $exception->getMessage());
            return redirect()->back()->with('status_fail', 'Lỗi');
        }
    }

    public function getResume($job_id, $student_id)
    {
        $student = Student::find($student_id);
        $resume = $this->jobService->getResumeByJobIdAndStudentId($job_id, $student_id);
        $application = Application::where('job_id', $job_id)
            ->where('student_id', $student_id)
            ->first();
        return view('management.pages.company.resume.mark', compact('resume', 'student', 'job_id', 'application'));
    }

    /**
     * Đánh dấu trạng thái cho một CV/Application cụ thể.
     */
    public function markResume(Request $request, $job_id, $student_id)
    {
        $application = Application::where('job_id', $job_id)
            ->where('student_id', $student_id)
            ->first();

        if (!$application) {
            return back()->with('status_fail', 'Không tìm thấy đơn ứng tuyển tương ứng.');
        }

        // Lấy thông tin công ty và job
        $user = Auth::guard('admin')->user();
        $company = $user->hiring ? $user->hiring->company : $user->company;

        if (!$company) {
            return back()->with('status_fail', 'Không tìm thấy thông tin công ty.');
        }
        $job = $application->job;

        // Cập nhật trạng thái
        $application->status = $request->status;
        $application->save();

        // Tạo thông báo cho sinh viên
        StudentNotification::create([
            'student_id' => $student_id,
            'title' => 'NTD vừa đánh giá CV của bạn',
            'content' => sprintf(
                'Nhà tuyển dụng %s vừa cập nhật trạng thái CV của bạn cho vị trí %s là %s',
                $company->name,
                $job->title ?? 'việc làm',
                $request->status === 'approved' ? 'Phù hợp' : 'Không phù hợp'
            ),
            'type' => 'resume_status',
            'action_url' => route('home.manageCV'),
            'metadata' => [
                'job_id' => $job_id,
                'company_id' => $company->id,
                'application_id' => $application->id,
                'status' => $request->status
            ]
        ]);

        $message = $request->status === 'approved' ? 'Đã duyệt CV thành công.' : 'Đã từ chối CV.';

        return redirect()
            ->route('company.showResumes', [
                'job_id' => $job_id,
                'tab' => $request->status === 'approved' ? 'approved' : 'rejected'
            ])
            ->with('status_success', $message);
    }

    public function markResumeScore(Request $request, $job_id, $student_id)
    {
        $application = Application::where('job_id', $job_id)
            ->where('student_id', $student_id)
            ->first();

        if (!$application) {
            return back()->with('status_fail', 'Không tìm thấy đơn ứng tuyển tương ứng.');
        }

        $application->score = $request->score;
        $application->review = $request->review;
        $application->save();

        return redirect()->back()->with('status_success', 'Đã cập nhật điểm và nhận xét.');
    }

    public function evaluate(Request $request, $job_id, $student_id)
    {
        // Tìm application ứng với job và student
        $application = Application::where('job_id', $job_id)
            ->where('student_id', $student_id)
            ->first();

        if (!$application) {
            return back()->with('status_fail', 'Không tìm thấy đơn ứng tuyển tương ứng.');
        }

        // Nếu đã có score và review, không gọi lại AI, chỉ trả về modal
        if ($application->score && $application->review) {
            return redirect()->back()
                ->with('status_success', 'Đã có đánh giá AI trước đó!')
                ->with('score', $application->score)
                ->with('review', $application->review);
        }

        $job_id = $application->job_id;
        $job = Job::find($job_id);

        $resume_id = $application->resume_id;
        $resume = Resume::find($resume_id);

        // Đọc nội dung resume (PDF)
        $parser = new Parser();
        $pdf = $parser->parseFile(storage_path('app/public/' . $resume->file_path));
        $resumeContent = $pdf->getText();

        // Prompt GPT
        $prompt = "
Bạn là chuyên gia tuyển dụng nhân sự.

Dưới đây là mô tả công việc (Job Description):

{$job->detail}

Và đây là nội dung CV của ứng viên:

{$resumeContent}

Hãy thực hiện các yêu cầu sau:

1. **Chấm điểm mức độ phù hợp** trên thang 0-100% (nêu rõ con số).
2. **Liệt kê các điểm mạnh nổi bật** của ứng viên so với vị trí này.
3. **Chỉ ra các điểm còn thiếu hoặc cần cải thiện** để phù hợp hơn với công việc.
4. **Đưa ra nhận xét tổng quan** về mức độ phù hợp của ứng viên với vị trí này.

Trả lời theo định dạng sau (giữ nguyên các tiêu đề):
Đưa ra nhận xét bằng các gạch đầu dòng
**Điểm phù hợp:** XX%

**Điểm mạnh:**
- ...

**Điểm cần cải thiện:**
- ...

**Nhận xét tổng quan:**
...


- ...
---

Nếu CV không liên quan đến công việc, điểm phù hợp tối đa là 20% và giải thích lý do rõ ràng.
        ";

        // Gọi GPT API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'gpt-4.1-nano', // Use the nano model for low-cost requests
            'prompt' => $prompt,
            'max_tokens' => 4000,  // Limit response size to keep costs low
        ]);

        $content = $response['choices'][0]['text'];

        // Tách điểm phù hợp
        preg_match('/\*?\*?Điểm phù hợp[:：]\*?\*?\s*([0-9]{1,3})\s*%?/u', $content, $match);
        $score = isset($match[1]) ? intval($match[1]) : null;

        // Lấy toàn bộ nội dung phản hồi vào review
        $review = trim($content);

        // Cập nhật vào DB
        $application->score = $score;
        $application->review = $review;
        $application->save();

        return redirect()->back()
            ->with('status_success', 'Đánh giá AI đã hoàn tất!')
            ->with('score', $score)
            ->with('review', $review);
    }

    public function static($job_id = null)
    {
        try {
            // Lấy danh sách job của công ty
            $jobs = $this->jobService->getPostsByCompany([]);

            if ($job_id) {
                // Lấy thông tin job được chọn
                $selectedJob = Job::findOrFail($job_id);

                // Lấy dữ liệu ứng viên theo trạng thái
                $applicants = $this->jobService->getApplicantsByJobId($job_id);

                // Tính toán số liệu thống kê
                $stats = [
                    'total' => count($applicants['pending']) + count($applicants['suitable']) + count($applicants['notSuitable']),
                    'pending' => count($applicants['pending']),
                    'suitable' => count($applicants['suitable']),
                    'notSuitable' => count($applicants['notSuitable'])
                ];

                // Lấy dữ liệu điểm đánh giá
                $scores = Application::where('job_id', $job_id)
                    ->whereNotNull('score')
                    ->pluck('score')
                    ->toArray();

                // Tính toán phân phối điểm
                $scoreDistribution = [
                    '0-20' => 0,
                    '21-40' => 0,
                    '41-60' => 0,
                    '61-80' => 0,
                    '81-100' => 0
                ];

                foreach ($scores as $score) {
                    if ($score <= 20) $scoreDistribution['0-20']++;
                    elseif ($score <= 40) $scoreDistribution['21-40']++;
                    elseif ($score <= 60) $scoreDistribution['41-60']++;
                    elseif ($score <= 80) $scoreDistribution['61-80']++;
                    else $scoreDistribution['81-100']++;
                }

                return view('management.pages.company.resume.static', compact('jobs', 'selectedJob', 'stats', 'scoreDistribution'));
            }

            return view('management.pages.company.resume.static', compact('jobs'));

        } catch (\Exception $exception) {
            Log::error('Lỗi thống kê: ' . $exception->getMessage());
            return redirect()->back()->with('status_fail', 'Có lỗi xảy ra khi tải dữ liệu thống kê');
        }
    }
}
