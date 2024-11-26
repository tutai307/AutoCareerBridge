<?php

namespace App\Imports;

use App\Http\Requests\StudentRequest;
use App\Models\Major;
use App\Models\Student;
use Auth;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Str;
use Validator;

class StudentsImport implements ToModel
{
    private $errorCount = 0;

    /**
     * @param array $row
     * 
     * @return \Illuminate\Database\Eloquent\Model | null
     */
    public function model(array $row)
    {
        $row[1] = Major::where('name', $row[1])->first()->id;

        $validator = Validator::make($row, [
            '0' => ['required', 'string', 'max:15', 'unique:students,student_code'],
            '1' => ['required', 'exists:majors,id'],
            '2' => ['required', 'string', 'min:3', 'max:255'],
            '3' => ['required', 'email', 'max:255', 'unique:students,email'],
            '4' => ['required', 'regex:/^(\+84 ?)?\d{9,10}$/'],
            '5' => ['required', 'string', Rule::in(['nam', 'nữ'])],
            '6' => ['required', 'date_format:U'],
            '7' => ['required', 'date_format:U'],
        ]);

        if ($validator->fails()) {
            Log::warning('Bỏ qua hàng có dữ liệu không hợp lệ', ['row' => $row]);
            $this->errorCount++;
            return null;
        }

        $gender = $row[5] === 'nam' ? 1 : 0;
        $entry_year = $this->excelSerialToDate($row[6]);
        $graduation_year = $this->excelSerialToDate($row[7]);


        return new Student([
            'university_id' => Auth::guard('admin')->user()->university->id,
            'student_code' => $row[0],
            'major_id' => $row[1],
            'name' => $row[2],
            'slug' => Str::slug($row[2] . '-' . $row[1] . '-' . Auth::guard('admin')->user()->university->abbreviation),
            'email' => $row[3],
            'phone' => $row[4],
            'gender' => $gender,
            'entry_year' => $entry_year,
            'graduation_year' => $graduation_year,
            'description' => $row[8],
        ]);
    }

    public function getErrorCount()
    {
        return $this->errorCount;
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
