<?php

namespace App\Http\Controllers;

use App\Models\Hiring;
use App\Services\HiringService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * 
 * create, update, and delete hiring accounts.
 *
 * @package App\Http\Controllers
 * @author Dang Duc Chung
 * @access public
 * @see index()
 * @see createHiring()
 * @see createHiring()
 * @see editHiring()
 * @see updateHiring()
 * @see deleteHiring()
 */

class HiringsController extends Controller
{
    protected $hiringService;
    public function __construct(HiringService $hiringService)
    {
        $this->hiringService = $hiringService;
    }
    /**
     * Display a list of the company's hirings.
     * @author Dang Duc Chung
     * @access public
     * @param none
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
            if ($request->has('searchName') || $request->has('searchEmail')) {
                $hirings = $this->hiringService->findHiring($request);
            } else {
                $hirings = $this->hiringService->getAllHirings();
            }
            return view('management.company.manage_hiring.index', compact('hirings'));

    }
    /**
     * Create a new hiring
     * @author Dang Duc Chung
     * @access public
     * @param \Illuminate\Http\Request $request The request containing the hiring data.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createHiring(Request $request)
    {
  
            $this->hiringService->createHiring($request);
            return Redirect::to('company/manage-hiring')->with('status_success', 'Thêm thành công');
     
    }
    /**
     * Edit an existing hiring record.
     * @author Dang Duc Chung
     * @access public
     * @param \Illuminate\Http\Request $request The request containing the hiring data.
     * @return hiring data
     */
    public function editHiring(Request $request)
    {

            $id = $request->id;
            return  $this->hiringService->editHiring($id);
    }
    /**
     * Update  an existing hiring record.
     * @author Dang Duc Chung
     * @access public
     * @param \Illuminate\Http\Request $request The request containing the hiring data.
     * @return \Illuminate\Http\RedirectResponse A redirect response with a success message after the update.
     */
    public function updateHiring(Request $request)
    {
 
            $this->hiringService->updateHiring($request);
            return Redirect::to('company/manage-hiring')->with('status_success', 'Cập nhật thành công');
      
    }
    /**
     * Delete a hiring record.
     * @author Dang Duc Chung
     * @access public
     * @param \Illuminate\Http\Request $request The request containing the hiring data.
     * @return \Illuminate\Http\RedirectResponse A redirect response with a success message after the update.
     */
    public function deleteHiring($id)
    {
            $this->hiringService->deleteHiring($id);
            return Redirect::to('company/manage-hiring')->with('status_success', 'Xóa thành công');
    }
}
