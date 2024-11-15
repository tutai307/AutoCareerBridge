<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Major;
use App\Services\Student\StudentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentsController extends Controller
{
    protected $studentService;

    /**
     * Create a new controller instance.
     *
     * @param StudentService $studentService The service responsible for student-related operations.
     * 
     * @access public
     */
    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Display a listing of the resource.
     *
     * This method fetches a list of students based on optional filters such as search, major, and date range.
     * It also retrieves all available majors to populate the filter options in the view.
     *
     * @param Request $request The request instance containing any filters.
     * 
     * @return \Illuminate\View\View The view containing the list of students and major filters.
     * 
     * @access public
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'major_id', 'date_range']);
        $majors = Major::all(['id', 'name']);
        $students = $this->studentService->getStudents($filters);
        
        return view('university.students.index', compact('students', 'majors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majors = Major::all(['id', 'name']);
        return view('university.students.create', compact('majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        try {
            $this->studentService->createStudent($request);
            return redirect()->route('university.students.index')->with('status_success', 'Tạo sinh viên thành công');
        } catch (Exception $exception) {
            Log::error('Lỗi thêm mới sinh viên: ' . $exception->getMessage());
            return back()->with('error', 'Lỗi thêm mới sinh viên');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
