<?php

namespace App\Services\Student;

use App\Repositories\Student\StudentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class StudentService
{
    protected $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function getStudents(array $filters)
    {
        return $this->studentRepository->getStudents($filters);
    }

    public function createStudent(array $request, array $skills)
    {
        $studentData = $this->processStudentData($request);

        $user = Auth::guard('admin')->user();
        if ($user->role === ROLE_SUB_UNIVERSITY) {
            $universityId = $user->academicAffair->university_id;
            if (!$universityId) {
                return false;
            }
        }
        if ($user->role === ROLE_UNIVERSITY) {
            $universityId = $user->university->id;
            if (!$universityId) {
                return false;
            }
        }

        $data = array_merge([
            'university_id' => $universityId,
            'name' => $request['name'],
            'student_code' => $request['student_code'],
            'slug' => $request['slug'],
            'major_id' => $request['major_id'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'gender' => $request['gender'],
            'description' => $request['description'],
        ], $studentData);

        $detail = $this->studentRepository->create($data);
        
        if (!$detail) {
            return false;
        }

        $detail->skills()->detach();
        foreach ($skills as $skill) {
            $detail->skills()->attach($skill);
        }
        
        return $detail;
    }

    public function getStudentBySlug($slug)
    {
        return $this->studentRepository->getBySlug($slug);
    }

    public function updateStudent(string $id, array $data, array $skills)
    {
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            return null;
        }

        $studentData = $this->processStudentData($data, $student);

        $universityId = Auth::guard('admin')->user()->university->id;
        if (!$universityId) {
            return false;
        }
        
        $data = array_merge([
            'university_id' => $universityId,
            'name' => $data['name'],
            'student_code' => $data['student_code'],
            'slug' => $data['slug'],
            'major_id' => $data['major_id'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'description' => $data['description'],
        ], $studentData);
        
        $this->studentRepository->update($id, $data);

        $student->skills()->detach();
        foreach ($skills as $skill) {
            $student->skills()->attach($skill);
        }

        return $student;
    }

    public function deleteStudent(string $id)
    {
        return $this->studentRepository->delete($id);
    }

    public function getStudentById(int $id)
    {
        return $this->studentRepository->getStudentById($id);
    }

    private function processStudentData(array $data, $student = null)
    {
        $avatarPath = $student ? $student->avatar_path : null;
        if (!empty($data['avatar_path']) && $data['avatar_path']->isValid()) {
            if ($student && $student->avatar_path && file_exists(storage_path('app/public/' . $student->avatar_path))) {
                unlink(storage_path('app/public/' . $student->avatar_path));
            }

            $avatarPath = $data['avatar_path']->store('student', 'public');
        }

        $entryYear = null;
        $graduationYear = null;
        if (!empty($data['date_range'])) {
            if (strpos($data['date_range'], 'to') !== false) {
                list($entryYear, $graduationYear) = explode(' to ', $data['date_range']);
                $entryYear = \Carbon\Carbon::createFromFormat('Y-m-d', $entryYear);
                $graduationYear = \Carbon\Carbon::createFromFormat('Y-m-d', $graduationYear);
            } elseif (strpos($data['date_range'], 'đến') !== false) {
                list($entryYear, $graduationYear) = explode(' đến ', $data['date_range']);
                $entryYear = \Carbon\Carbon::createFromFormat('Y-m-d', $entryYear);
                $graduationYear = \Carbon\Carbon::createFromFormat('Y-m-d', $graduationYear);
            } else {
                $entryYear = \Carbon\Carbon::createFromFormat('Y-m-d', $data['date_range']);
            }
        }

        return [
            'avatar_path' => $avatarPath,
            'entry_year' => $entryYear,
            'graduation_year' => $graduationYear,
        ];
    }
}
