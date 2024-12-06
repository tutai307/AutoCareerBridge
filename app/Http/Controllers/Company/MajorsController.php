<?php

namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use App\Services\Major\MajorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class MajorsController extends Controller
{
    protected $majorService;

    public function __construct(MajorService $majorService )
    {
        $this->majorService = $majorService;
    }


    public function getAvailableMajorsForCompany(Request $request)
    {
        $fieldId = $request->query('field_id');
        $majors = $this->majorService->getAvailableMajorsForCompany($fieldId);
        return response()->json($majors);
    }

    public function index(Request $request)
    {
        try{
        $fields=$this->majorService->getFields();
        $majors = $this->majorService->getMajorsCompany($request);
    
        return view('management.pages.company.majors.index', compact('majors', 'fields'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('status_fail', 'Lỗi tạo lấy chuyên ngành');
        };
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
            'field_id' => 'required',
        ]);
        try{
        $this->majorService->storeMajorsCompany($request);
        return redirect()->route('company.majorCompany')->with('status_success', 'Thêm thành công');
        } catch (\Exception $e){
        Log::error($e->getMessage());
        return redirect()->back()->with('status_fail', 'Lỗi tạo chuyên ngành');
        }
    }

    public function delete($majorId)
    {
        try{
        $this->majorService->removeMajorsCompany($majorId);
        return redirect()->route('company.majorCompany')->with('status_success', 'Xóa thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('status_fail', 'Lỗi xóa chuyên ngành');
        }
    }

}
