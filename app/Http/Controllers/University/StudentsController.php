<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Major;
use App\Models\Student;
use App\Services\Student\StudentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $majors = Major::all(['id', 'name']);
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
        $majors = Major::all(['id', 'name']);
        return view('management.pages.university.students.create', compact('majors'));
    }

    /**
     * Store a newly created student in storage.
     *
     * This method processes the request to create a student. On success, redirects to the student list.
     * On failure, logs the error and redirects back with an error message.
     *
     * @param StudentRequest $request The validated request data for creating a student.
     * 
     * @return \Illuminate\Http\RedirectResponse Redirect response to the student list.
     * 
     * @throws Exception If an error occurs during student creation.
     * @see StudentService::createStudent()
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
        $majors = Major::all(['id', 'name']);
        $student = $this->studentService->getStudentBySlug($slug);
        return view('management.pages.university.students.edit', compact('student', 'majors'));
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
        try {
            $this->studentService->updateStudent($id, $request->all());
            return back()->with('status_success', 'Cập nhật sinh viên thành công');
        } catch (Exception $exception) {
            Log::error('Lỗi cập nhật sinh viên: ' . $exception->getMessage());
            return back()->with('error', 'Lỗi cập nhật sinh viên')->withInput();
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
                return back()->with('error', 'Sinh viên không tồn tại');
            }
            $this->studentService->deleteStudent($student->id);
            return back()->with('status_success', 'Xóa sinh viên thành công');
        } catch (Exception $exception) {
            Log::error('Lỗi xóa sinh viên: ' . $exception->getMessage());
            return back()->with('error', 'Lỗi xóa sinh viên');
        }
    }
}
