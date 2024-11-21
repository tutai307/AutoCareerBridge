<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcademicAffairsRequest;
use App\Services\AcademicAffairs\AcademicAffairsService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;

class AcademicAffairsController extends Controller
{
    protected $academicAffairsService;
    protected $userId;
    protected $universityId;
    public function __construct(AcademicAffairsService $academicAffairsService)
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->guard('admin')->user();
            if (!$user || $user->role !== 3 || $user->university->isEmpty()) {
                return back()->with('error', 'Bạn không có quyền truy cập!');
            }
            $this->universityId = $user->university->first()->id;

            return $next($request);
        });
        $this->academicAffairsService = $academicAffairsService;
    }
    public function index(Request $request)
    {
        if ($request->has('searchName') || $request->has('searchEmail')) {
            $academicAffairs = $this->academicAffairsService->find($request, $this->universityId);
        } else {
            $academicAffairs = $this->academicAffairsService->index($this->universityId);
        }
        return view('university.academic_affairs.index', compact('academicAffairs'));
    }

    public function create()
    {
        return view('university.academic_affairs.create');
    }

    public function store(AcademicAffairsRequest $request)
    {
        try {
            $this->academicAffairsService->store($request, $this->universityId);
            return redirect()->route('university.academicAffairs')
                ->with('status_success', 'Thêm thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Lỗi thêm mới giáo vụ');
        }
    }

    public function edit($usedId)
    {
        $academicAffairs = $this->academicAffairsService->edit($usedId);
        return view('university.academic_affairs.edit', compact('academicAffairs'));
    }

    public function update(Request $request, $usedId)
    {
        try {
            $academicAffairs = $this->academicAffairsService->update($request, $usedId);
            return redirect()->route('university.academicAffairs')
                ->with('status_success', 'Cập nhật thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Lỗi cập nhật giáo vụ');
        }
    }

    public function delete($id)
    {
        $this->academicAffairsService->delete($id);
        return redirect()->route('university.academicAffairs')
            ->with('status_success', 'Xóa thành công');
    }
}
