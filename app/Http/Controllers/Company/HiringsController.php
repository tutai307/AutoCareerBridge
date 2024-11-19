<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Hiring;
use App\Services\Company\HiringService;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\HiringRequest;
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
        protected $userId;
        protected $companyId;
        public function __construct(HiringService $hiringService)
        {
                $this->hiringService = $hiringService;
                $this->middleware(function ($request, $next) {
                        $user = auth()->guard('admin')->user();
                        if (!$user || $user->role !== 2 || !$user->company) {
                                return back()->with('error', 'Bạn không có quyền truy cập!');
                        }
                        $this->userId = $user->id;
                        $this->companyId = $user->company->id;

                        return $next($request);
                });
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
                        $hirings = $this->hiringService->findHiring($request, $this->companyId);
                } else {
                        $hirings = $this->hiringService->getAllHirings($this->companyId);
                }
                return view('company.manage_hiring.index', compact('hirings'));
        }
        /**
         * Create a new hiring
         * @author Dang Duc Chung
         * @access public
         * @param \Illuminate\Http\Request $request The request containing the hiring data.
         * @return \Illuminate\Http\RedirectResponse
         */
        public function createHiring(HiringRequest $request)
        {

                $this->hiringService->createHiring($request, $this->companyId);
                return Redirect::to('company/manageHiring')->with('status_success', 'Thêm thành công');
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
        public function updateHiring(HiringRequest $request,)
        {

                $this->hiringService->updateHiring($request, $this->companyId);
                return Redirect::to('company/manageHiring')->with('status_success', 'Cập nhật thành công');
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
                return Redirect::to('company/manageHiring')->with('status_success', 'Xóa thành công');
        }
}
