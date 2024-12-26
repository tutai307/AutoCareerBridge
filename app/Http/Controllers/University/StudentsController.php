<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Http\Requests\University\StudentRequest;
use App\Imports\StudentsImport;
use App\Models\Student;
use App\Services\Skill\SkillService;
use App\Services\Student\StudentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use App\Services\Major\MajorService;

/**
 * StudentsController handles student management operations in the university module.
 *
 * This includes listing, creating, editing, updating, and deleting student records.
 *
 * @package App\Http\Controllers\University
 * @author Khuat Van Duy
 * @access public
 * @see index()
 * @see create()
 * @see store()
 * @see edit()
 * @see update()
 * @see destroy()
 */

class StudentsController extends Controller
{
    protected $studentService;
    protected $majorService;

    protected $skillService;

    /**
     * Create a new controller instance.
     *
     * @param StudentService $studentService The service responsible for student-related operations.
     * @param MajorService $majorService The service responsible for major-related operations.
     * @param SkillService $skillService The service responsible for skill-related operations.
     *
     * @access public
     */
    public function __construct(StudentService $studentService, MajorService $majorService, SkillService $skillService)
    {
        $this->studentService = $studentService;
        $this->majorService = $majorService;
        $this->skillService = $skillService;
    }

    /**
     * Display a listing of the students with optional filters.
     *
     * This method retrieves students based on filters such as search, major, and date range.
     * It also fetches all majors to populate the filter dropdown.
     *
     * @param Request $request The HTTP request instance with filter parameters.
     *
     * @return \Illuminate\View\View The view containing the student list and filter options.
     *
     * @access public
     * @see StudentService::getStudents()
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'major_id', 'date_range']);
        $majors = $this->majorService->getMajorByUniversity();
        $students = $this->studentService->getStudents($filters);

        return view('management.pages.university.students.index', compact('students', 'majors'));
    }

    /**
     * Show the form for creating a new student.
     *
     * @return \Illuminate\View\View The view displaying the student creation form.
     *
     * @access public
     */
    public function create()
    {
        $skills = $this->skillService->getAll();
        $majors = $this->majorService->getMajorByUniversity();
        return view('management.pages.university.students.create', compact('majors', 'skills'));
    }

    /**
     * Store a newly created student in storage.
     *
     * This method processes the request to create a student. On success, redirects to the student list.
     * On failure, logs the error and redirects back with an error message.
     *
     * @param \App\Http\Requests\University\StudentRequest $request The validated request data for creating a student.
     *
     * @return \Illuminate\Http\RedirectResponse Redirect response to the student list.
     *
     * @throws Exception If an error occurs during student creation.
     * @see StudentService::createStudent()
     */
    public function store(StudentRequest $request)
    {
        DB::beginTransaction();
        try {
            $skills = $this->skillService->createSkill($request->skill_name);
            if (!$skills) {
                throw new Exception("Tạo kỹ năng thất bại");
            }

            $student = $this->studentService->createStudent($request->all(), $skills);
            if (!$student) {
                throw new Exception("Tạo sinh viên thất bại");
            }
            DB::commit();
            return redirect()->route('university.students.index')->with('status_success', 'Tạo sinh viên thành công');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Lỗi thêm mới sinh viên: ' . $exception->getMessage());
            return back()->with('status_fail', 'Lỗi thêm mới sinh viên');
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
     * Show the form for editing a student.
     *
     * This method retrieves the student data by slug and fetches all majors for the edit form.
     *
     * @param string $slug The slug of the student to edit.
     *
     * @return \Illuminate\View\View The view displaying the student edit form.
     *
     * @access public
     * @see StudentService::getStudentBySlug()
     */
    public function edit(string $slug)
    {
        $majors = $this->majorService->getMajorByUniversity();

        $student = $this->studentService->getStudentBySlug($slug);
        if (!$student) {
            abort(404, 'Sinh viên không tồn tại');
        }
        if (!in_array(Auth::guard('admin')->user()->role, [ROLE_UNIVERSITY, ROLE_SUB_UNIVERSITY])) {
            abort(403, 'Bạn không có quyền thay đổi sinh viên');
        }
        if (Auth::guard('admin')->user()->role === ROLE_UNIVERSITY && $student->university_id !== Auth::guard('admin')->user()->university->id) {
            abort(403, 'Bạn không có quyền thay đổi sinh viên này');
        }
        if (Auth::guard('admin')->user()->role === ROLE_SUB_UNIVERSITY && $student->university_id !== Auth::guard('admin')->user()->academicAffair->university_id) {
            abort(403, 'Bạn không có quyền thay đổi sinh viên này');
        }

        $skills = $this->skillService->getAll();
        return view('management.pages.university.students.edit', compact('student', 'majors', 'skills'));
    }

    /**
     * Update the specified student in storage.
     *
     * This method processes the request to update student details. On success, redirects back with a success message.
     * On failure, logs the error and redirects back with the input data and an error message.
     *
     * @param StudentRequest $request The validated request data for updating a student.
     * @param string $id The ID of the student to update.
     *
     * @return \Illuminate\Http\RedirectResponse Redirect response to the previous page.
     *
     * @throws Exception If an error occurs during student update.
     * @see StudentService::updateStudent()
     */
    public function update(StudentRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $skills = [];
            $skills = $this->skillService->createSkill($request->skill_name);
            if (!$skills) {
                throw new Exception("Tạo kỹ năng thất bại");
            }

            $student = $this->studentService->updateStudent($id, $request->all(), $skills);
            if (!$student) {
                throw new Exception("Cập nhật sinh viên thất bại");
            }
            DB::commit();
            return back()->with('status_success', 'Cập nhật sinh viên thành công');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Lỗi cập nhật sinh viên: ' . $exception->getMessage());
            return back()->with('status_fail', 'Lỗi cập nhật sinh viên')->withInput();
        }
    }

    /**
     * Remove the specified student from storage.
     *
     * This method deletes a student by their ID. On success, redirects back with a success message.
     * On failure, logs the error and redirects back with an error message.
     *
     * @param Student $student The student instance to delete.
     *
     * @return \Illuminate\Http\RedirectResponse Redirect response with status message.
     *
     * @throws Exception If an error occurs during deletion.
     * @see StudentService::deleteStudent()
     */
    public function destroy(Student $student)
    {
        try {
            $studentExists = $this->studentService->getStudentById($student->id);
            if (!$studentExists) {
                return back()->with('status_fail', 'Sinh viên không tồn tại');
            }
            if (!in_array(Auth::guard('admin')->user()->role, [ROLE_UNIVERSITY, ROLE_SUB_UNIVERSITY])) {
                abort(403, 'Bạn không có quyền xóa sinh viên');
            }
            if (Auth::guard('admin')->user()->role === ROLE_UNIVERSITY && $student->university_id !== Auth::guard('admin')->user()->university->id) {
                abort(403, 'Bạn không có quyền xóa sinh viên này');
            }
            if (Auth::guard('admin')->user()->role === ROLE_SUB_UNIVERSITY && $student->university_id !== Auth::guard('admin')->user()->academicAffair->university_id) {
                abort(403, 'Bạn không có quyền xóa sinh viên này');
            }
            $this->studentService->deleteStudent($student->id);
            return back()->with('status_success', 'Xóa sinh viên thành công');
        } catch (Exception $exception) {
            Log::error('Lỗi xóa sinh viên: ' . $exception->getMessage());
            return back()->with('status_fail', 'Lỗi xóa sinh viên');
        }
    }

    /**
     * Import student data from an uploaded file.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function import()
    {
        $import = new StudentsImport();
        $user = Auth::guard('admin')->user();
        if ($user->role === ROLE_SUB_UNIVERSITY) {
            $universityId = $user?->academicAffair?->university_id;
            $abbreviation = $user?->academicAffair?->university?->abbreviation;
            if (!$universityId || !$abbreviation) {
                throw new Exception('Không thể xác định trường học đang đăng nhập');
            }
        }
        if ($user->role === ROLE_UNIVERSITY) {
            $universityId = $user?->university?->id;
            $abbreviation = $user?->university?->abbreviation;
            if (!$universityId || !$abbreviation) {
                throw new Exception('Không thể xác định trường học đang đăng nhập');
            }
        }
        $import->setUniversityId($universityId, $abbreviation);

        try {
            $file = request()->file('file');
            if (!in_array($file->getClientOriginalExtension(), ['xlsx', 'xls'])) {
                return back()->with('status_fail', 'Vui lòng nhập file có định dạng .xlxs hoặc .xls!');
            }

            Excel::import($import, request()->file('file'));

            $errors = $import->getErrors();
            $successCount = $import->getSuccessCount();

            if (empty($errors) && $successCount == 0) {
                return back()->with('status_fail', 'Không có sinh viên nào được thêm vào do file chưa có bản ghi.');
            }
            if (!empty($errors)) {
                $errorMessages = implode('<br>', array_map(function ($error) {
                    return is_array($error) ? implode(', ', array_map('strval', $error)) : $error;
                }, $errors));
                if ($successCount > 0) {
                    return back()->with('import_fail', $errorMessages)->with('status_success', 'Import sinh viên thành công ' . $successCount . ' bản ghi');
                } else {
                    return back()->with('import_fail', $errorMessages);
                }
            }

            return redirect('/university/students')->with('status_success', 'Import sinh viên thành công ');
        } catch (Exception $exception) {
            Log::error('Lỗi import sinh viên: ' . $exception->getMessage());
            return back()->with('status_fail', 'Lỗi import sinh viên');
        }
    }

    public function downloadTemplate()
    {
        // Đường dẫn tới file mẫu
        $filePath = public_path('management-assets/template/import_student_template.xlsx');

        if (!file_exists($filePath)) {
            abort(404, 'File không tồn tại.');
        }

        return Response::download($filePath, 'import_student_template.xlsx');
    }
}
