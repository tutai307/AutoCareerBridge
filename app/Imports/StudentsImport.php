<?php

namespace App\Imports;

use App\Http\Requests\University\ImportStudentRequest;
use App\Models\Major;
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
    private $errors = [];
    private $successCount = 0;

    public function setUniversityId($university_id)
    {
        $this->university_id = $university_id;
    }

    /**
     * Determine the row number of the first model to be imported.
     *
     * @return int
     */
    public function startRow(): int
    {
        return 3; // Bắt đầu từ dòng 3
    }

    /**
     * @param array $row
     * 
     * @return \Illuminate\Database\Eloquent\Model | null
     */
    public function model(array $row)
    {
        static $rowIndex = 3;

        try {
            if (count($row) !== 9) {
                Log::warning("File không đúng mẫu");
                $this->errors = ["File không đúng mẫu, số cột phải là 9 cột"];
                return null;
            }

            $request = new ImportStudentRequest();
            $request->merge($row);
            $validator = Validator::make($row, $request->rules(), $request->messages());

            // Kiểm tra ngành và lấy ID
            $major = Major::where('name', $row[1])->first();
            $majorId = $major ? $major->id : null;

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    // Log thông tin lỗi theo dòng
                    Log::warning("Dòng {$rowIndex}: $error", ['row' => $row]);
                    $this->errors[] = ["Dòng {$rowIndex}: $error"];
                }
                return null;
            }

            if (!$majorId) {
                Log::warning("Dòng {$rowIndex}: Ngành không tồn tại", ['row' => $row]);
                $this->errors[] = ["Dòng {$rowIndex}: Ngành không tồn tại"];
                return null;
            }

            $gender = $row[5] === 'nam' ? MALE_GENDER : FEMALE_GENDER;
            $entry_year = $this->excelSerialToDate($row[6]);
            $graduation_year = $this->excelSerialToDate($row[7]);

            $newStudent = new Student([
                'university_id' => $this->university_id,
                'student_code' => $row[0],
                'major_id' => $majorId,
                'name' => $row[2],
                'slug' => Str::slug($row[2] . '-' . $majorId . '-' . $this->university_id),
                'email' => $row[3],
                'phone' => $row[4],
                'gender' => $gender,
                'entry_year' => $entry_year,
                'graduation_year' => $graduation_year,
                'description' => $row[8],
            ]);
            $newStudent->save();

            $this->successCount++;
        } catch (\Exception $e) {
            Log::error("Dòng {$rowIndex}: Lỗi xảy ra", ['row' => $row, 'exception' => $e->getMessage()]);
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
