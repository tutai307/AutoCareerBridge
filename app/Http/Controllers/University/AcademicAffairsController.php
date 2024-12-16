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
         
            if ( $user->university === null){
                return back()->with('status_fail', 'Bạn không có quyền truy cập!');
            }
            $this->universityId = $user->university->id;
            return $next($request);
        });
        $this->academicAffairsService = $academicAffairsService;
    }
    public function index(Request $request)
    {
      
            $academicAffairs = $this->academicAffairsService->getAcademicAffairs($request,$this->universityId);
        return view('management.pages.university.academic_affairs.index', compact('academicAffairs'));
    }

    public function create()
    {
        return view('management.pages.university.academic_affairs.create');
    }

    public function store(AcademicAffairsRequest $request)
    {
        try {
            $this->academicAffairsService->store($request, $this->universityId);
            return redirect()->route('university.academicAffairs')
                ->with('status_success', 'Thêm thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('status_fail', 'Lỗi thêm mới giáo vụ');
        }
    }

    public function edit($usedId)
    {
        $academicAffairs = $this->academicAffairsService->edit($usedId);
        return view('management.pages.university.academic_affairs.edit', compact('academicAffairs'));
    }

    public function update(AcademicAffairsRequest $request, $usedId)
    {
        try {
            $academicAffairs = $this->academicAffairsService->update($request, $usedId);
            return redirect()->route('university.academicAffairs')
                ->with('status_success', 'Cập nhật thành công');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('status_fail', 'Lỗi cập nhật giáo vụ');
        }
    }

    public function delete($id)
    {
        $this->academicAffairsService->delete($id);
        return back()->with('status_success', 'Xóa thành công');
    }
}
