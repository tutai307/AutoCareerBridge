<?php

namespace App\Imports;

use App\Http\Requests\University\ImportStudentRequest;
use App\Models\Major;
use App\Models\Skill;
use App\Models\Student;
use Carbon\Carbon;
use Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Str;
use Validator;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentsImport implements ToModel, WithStartRow
{
    public $university_id;
    public $abbreviation;
    private $errors = [];
    private $successCount = 0;

    public function setUniversityId($university_id, $abbreviation)
    {
        $this->university_id = $university_id;
        $this->abbreviation = $abbreviation;
    }

    /**
     * Determine the row number of the first model to be imported.
     *
     * @return int
     */
    public function startRow(): int
    {
        return 1; // Bắt đầu từ dòng 1
    }

    /**
     * @param array $row
     * 
     * @return \Illuminate\Database\Eloquent\Model | null
     */
    public function model(array $row)
    {
        static $rowIndex = 1;
        $data = [];

        $expectedHeaders = [
            "Mã sinh viên *",
            "Tên chuyên ngành *",
            "Họ và tên sinh viên *",
            "Email *",
            "Số điện thoại *",
            "Giới tính (nam hoặc nữ) *",
            "Ngày nhập học *",
            "Ngày ra trường",
            "Kỹ năng",
            "Mô tả"
        ];

        if ($rowIndex == 1) {
            $row = array_values(array_filter($row, function ($value) {
                return !is_null($value);
            }));
            if ($row !== $expectedHeaders) {
                Log::warning("File không đúng mẫu. Dòng tiêu đề không khớp với mẫu.", ['row' => $row]);
                $this->errors = ["File không đúng định dạng. Dòng tiêu đề không khớp với mẫu"];
                return;
            }
    
            $rowIndex++;
            return null;
        }

        if (empty(array_filter($row))) {
            return null;
        }

        try {
            $row = array_map(function ($value) {
                return $value ?? '';
            }, $row);

            if (count($row) !== 10) {
                Log::warning("Dòng {$rowIndex}: Không đúng mẫu");
                $this->errors[] = ["Dòng {$rowIndex}: Không đúng mẫu, số cột phải là 9 cột"];
                return null;
            }

            $request = new ImportStudentRequest();
            $request->merge($row);

            $data = [
                'student_code' => $row[0],
                'major' => $row[1],
                'name' => $row[2],
                'email' => $row[3],
                'phone' => $row[4],
                'gender' => $row[5],
                'entry_year' => $row[6],
                'graduation_year' => $row[7],
                'skills' => $row[8],
                'description' => $row[9],
                'slug' => Str::slug($row[2] . '-' . $row[0] . '-' . $this->abbreviation),
            ];

            $validator = Validator::make($data, $request->rules(), $request->messages());

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    // Log thông tin lỗi theo dòng
                    Log::warning("Dòng {$rowIndex}: $error", ['row' => $data]);
                    $this->errors[] = ["Dòng {$rowIndex}: $error"];
                }
                return null;
            }

            $skills = array_map('trim', explode(',', $data['skills']));
    
            $skillIds = [];
            foreach ($skills as $skillName) {
                $skill = Skill::firstOrCreate(['name' => $skillName], ['slug' => Str::slug($skillName)]);
                $skillIds[] = $skill->id;
            }

            $major = Major::where('name', $data['major'])->first();

            $gender = $data['gender'] === 'nam' ? MALE_GENDER : FEMALE_GENDER;
            $entry_year = $this->excelSerialToDate($data['entry_year']);
            $graduation_year = $this->excelSerialToDate($data['graduation_year']);

            $newStudent = new Student([
                'university_id' => $this->university_id,
                'student_code' => $data['student_code'],
                'major_id' => $major->id,
                'name' => $data['name'],
                'slug' => $data['slug'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'gender' => $gender,
                'entry_year' => $entry_year,
                'graduation_year' => $graduation_year,
                'description' => $data['description'],
            ]);
            $newStudent->save();

            $newStudent->skills()->sync($skillIds);

            $this->successCount++;
        } catch (\Exception $e) {
            Log::error("Dòng {$rowIndex}: Lỗi xảy ra", ['row' => $data, 'exception' => $e->getMessage()]);
            $this->errors[] = ["Dòng {$rowIndex}: Có lỗi xảy ra"];
            return null;
        } finally {
            $rowIndex++;
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getSuccessCount()
    {
        return $this->successCount;
    }

    private function excelSerialToDate($serial)
    {
        if (!is_numeric($serial)) {
            Log::error('Định dạng ngày không hợp lệ', ['serial' => $serial]);
            return null;
        }

        try {
            return Carbon::createFromFormat('Y-m-d', Carbon::createFromFormat('Y-m-d', '1900-01-01')->addDays($serial - 2)->format('Y-m-d'))->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
