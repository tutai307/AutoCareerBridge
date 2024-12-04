<?php

namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use App\Services\Major\MajorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MajorsController extends Controller
{
    protected $majorService;

    public function __construct(MajorService $majorService )
    {
        $this->majorService = $majorService;
    }

    public function index(Request $request)
    {
        $fields=$this->majorService->getFields();
        $majors = $this->majorService->getMajorsCompany($request);
    
        return view('management.pages.company.majors.index', compact('majors', 'fields'));
    }

    public function create()
    {
        $fields=$this->majorService->getFields();
        return view('management.pages.company.majors.create',compact('fields'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'major_id' => 'required|array',
            'major_id.*' => [
                'nullable',
                Rule::unique('company_majors', 'major_id')
                ->where('company_id', Auth::guard('admin')->user()->company->id)
                    ->whereNull('deleted_at'), 
            ],
            'field_id' => 'required',
        ], [
            'major_id.*.unique' => 'Chuyên ngành đã tồn tại', 
        ]);

        $this->majorService->storeMajorsCompany($request);
        return redirect()->route('company.majorCompany')->with('status_success', 'Thêm thành công');
    }

    public function delete($majorId)
    {
        $this->majorService->removeMajorsCompany($majorId);
        return redirect()->route('company.majorCompany')->with('status_success', 'Xóa thành công');
    }

    public function getMajorsByField($fieldId){
        $this->majorService->getMajorsByField($fieldId);
    }
}
