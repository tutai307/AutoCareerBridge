<?php

namespace App\Services\Student;

use App\Repositories\Student\StudentRepositoryInterface;

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

    public function createStudent($request)
    {
        $avatarPath = null;
        if ($request->hasFile('avatar_path') && $request->file('avatar_path')->isValid()) {
            $avatarPath = $request->file('avatar_path')->store('student', 'public');
        }

        $entryYear = null;
        $graduationYear = null;
        if (!empty($request->date_range)) {
            $dateRange = explode(" to ", $request->date_range);

            $entryYear = \Carbon\Carbon::createFromFormat('Y-m-d', $dateRange[0]);

            if (isset($dateRange[1])) {
                $graduationYear = \Carbon\Carbon::createFromFormat('Y-m-d', $dateRange[1]);
            }
        }

        $data = [
            'university_id' => 1, // Phần đăng nhập chưa ok nên đang fix cứng
            'name' => $request->name,
            'student_code' => $request->student_code,
            'slug' => $request->slug,
            'major_id' => $request->major_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'description' => $request->description,
            'avatar_path' => $avatarPath,
            'entry_year' => $entryYear,
            'graduation_year' => $graduationYear,
        ];

        return $this->studentRepository->create($data);
    }

    public function getStudentBySlug($slug)
    {
        return $this->studentRepository->getBySlug($slug);
    }

    public function updateStudent(string $id, array $data)
    {
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            return null;
        }

        $avatarPath = $student->avatar_path;
        if (!empty($data['avatar_path']) && $data['avatar_path']->isValid()) {
            if ($student->avatar_path && file_exists(storage_path('app/public/' . $student->avatar_path))) {
                unlink(storage_path('app/public/' . $student->avatar_path));
            }

            $avatarPath = $data['avatar_path']->store('student', 'public');
        }

        $entryYear = null;
        $graduationYear = null;
        if (!empty($data['date_range'])) {
            $dateRange = explode(" to ", $data['date_range']);

            $entryYear = \Carbon\Carbon::createFromFormat('Y-m-d', $dateRange[0]);

            if (isset($dateRange[1])) {
                $graduationYear = \Carbon\Carbon::createFromFormat('Y-m-d', $dateRange[1]);
            }
        }

        $data = [
            'university_id' => 1, // Phần đăng nhập chưa ok nên đang fix cứng
            'name' => $data['name'],
            'student_code' => $data['student_code'],
            'slug' => $data['slug'],
            'major_id' => $data['major_id'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'description' => $data['description'],
            'avatar_path' => $avatarPath,
            'entry_year' => $entryYear,
            'graduation_year' => $graduationYear,
        ];

        return $this->studentRepository->update($id, $data);

    }
}
