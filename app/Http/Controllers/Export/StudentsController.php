<?php

namespace App\Http\Controllers\Export;

use App\Exports\StudentsDataExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class StudentsController extends Controller
{
    public function export()
    {
        return Excel::download(new StudentsDataExport(), 'students.xlsx');
    }
}
