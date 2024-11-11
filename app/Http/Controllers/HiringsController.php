<?php

namespace App\Http\Controllers;

use App\Models\Hiring;
use App\Services\HiringService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HiringsController extends Controller
{
    protected $hiringService;

    public function __construct(HiringService $hiringService){
        $this->hiringService = $hiringService;
    }

    public function index(){
        $hirings = $this->hiringService->getAllHirings();
        return view('management.company.manager_hiring.index',compact('hirings'));
    }

    public function createHiring(Request $request){
       $this->hiringService->createHiring($request);
       return Redirect::to('company/manager-hiring')->with('status_success', 'Thêm thành công');
    }

    public function editHiring( Request $request){
        $id = $request->id;
   
    return  $this->hiringService->editHiring($id);
       
    }

    public function updateHiring(Request $request){
        $this->hiringService->updateHiring($request);
       return Redirect::to('company/manager-hiring')->with('status_success', 'Cập nhật thành công');
    }

    public function deleteHiring($id){
        $this->hiringService->deleteHiring($id);
       return Redirect::to('company/manager-hiring')->with('status_success', 'Xóa thành công');
    }
}
