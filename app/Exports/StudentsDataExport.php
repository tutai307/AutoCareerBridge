<?php

namespace App\Exports;

use App\Models\Student;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentsDataExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return Student::with(['major:id,name'])
            ->where('university_id', auth()->guard('admin')?->user()?->university?->id)
            ->get(['name', 'student_code', 'email', 'phone', 'major_id', 'entry_year', 'graduation_year'])
            ->map(function ($student) {
                $entryYear = Carbon::parse($student->entry_year);
                $graduationYear = $student->graduation_year ? Carbon::parse($student->graduation_year) : null;

                return [
                    $student->student_code,
                    $student->name,
                    $student->email,
                    $student->phone,
                    $student->major?->name ?? '',
                    $entryYear->format('d/m/Y'),
                    $graduationYear ? $graduationYear->format('d/m/Y') : ''
                ];
            });
    }

    public function headings(): array
    {
        return [
            __('label.university.student.student_code'),
            __('label.university.student.name'),
            __('label.university.student.email'),
            __('label.university.student.phone'),
            __('label.university.student.major'),
            __('label.university.student.entry_year'),
            __('label.university.student.graduation_year')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['rgb' => '007BFF'],
                ],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }
}
