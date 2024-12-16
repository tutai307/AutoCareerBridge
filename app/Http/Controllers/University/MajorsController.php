<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Fields;
use App\Models\Major;
use App\Models\UniversityMajor;
use App\Services\Major\MajorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MajorsController extends Controller
{
    protected $majorServices;
    public function __construct(MajorService $majorService)
    {
        $this->majorServices = $majorService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['field_id', 'major_id']);
        $majors = $this->majorServices->getMajors($filters);
        $majors_data = Major::all();
        return view('management.pages.university.majors.index', compact('majors', 'majors_data'));
    }

    public function create()
    {
        $user = Auth::guard('admin')->user();
        if ($user->role === ROLE_SUB_UNIVERSITY) {
            $universityId = $user->academicAffair->university_id;
        }
        if ($user->role === ROLE_UNIVERSITY) {
            $universityId = $user->university->id;
        }
        $data = $this->majorServices->getMajorsForUniversity($universityId);


        return view('management.pages.university.majors.create', [
            'majors_data' => $data['majors'],
            'majors_existed' => $data['majors_existed'],
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::guard('admin')->user();
        if ($user->role === ROLE_SUB_UNIVERSITY) {
            $universityId = $user->academicAffair->university_id;
        }
        if ($user->role === ROLE_UNIVERSITY) {
            $universityId = $user->university->id;
        }
        $selectedMajors = $request->input('major_id', []);

        if (empty($selectedMajors)) {
            return redirect()->back()->with('status_fail', 'Vui lòng chọn ít nhất một ngành học!');
        }

        foreach ($selectedMajors as $majorId) {
            $this->majorServices->addOrRestoreMajor($universityId, $majorId);
        }

        return redirect()->route('university.majors.index')
            ->with('status_success', 'Ngành học đã được thêm thành công!');
    }

    public function destroy($majorId)
    {
        $result = $this->majorServices->deleteMajor($majorId);

        if ($result['status']) {
            return redirect()->route('university.majors.index')
                ->with('status_success', $result['message']);
        }

        return redirect()->route('university.majors.index')
            ->with('status_fail', $result['message']);
    }

    public function getMajorsAll(Request $request)
    {
        $fieldId = $request->query('field_id');
        $majors = Major::where('field_id', $fieldId)
            ->get();
        return response()->json($majors);
    }
}
