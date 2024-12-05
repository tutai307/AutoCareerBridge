<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Hiring;
use App\Services\Company\HiringService;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\HiringRequest;
use Illuminate\Support\Facades\Log;
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
                $hirings = $this->hiringService->getHirings($request, $this->companyId);
                return view('management.pages.company.manage_hiring.index', compact('hirings'));
        }
        public function create()
        {
                return view('management.pages.company.manage_hiring.create');
        }

        /**
         * Create a new hiring
         * @author Dang Duc Chung
         * @access public
         * @param \Illuminate\Http\Request $request The request containing the hiring data.
         * @return \Illuminate\Http\RedirectResponse
         */
        public function store(HiringRequest $request)
        {
                try {
                        $this->hiringService->createHiring($request, $this->companyId);
                        return Redirect::route('company.manageHiring')->with('status_success', 'Thêm thành công');
                } catch (Exception $e) {
                        Log::error($e->getMessage());
                        return back()->with('error', 'Thêm nhân viên thất bại');
                }
        }
        /**
         * Edit an existing hiring record.
         * @author Dang Duc Chung
         * @access public
         * @param \Illuminate\Http\Request $request The request containing the hiring data.
         * @return hiring data
         */
        public function edit($userID)
        {
                $hiring = $this->hiringService->editHiring($userID);
                return view('management.pages.company.manage_hiring.edit', compact('hiring'));
        }
        /**
         * Update  an existing hiring record.
         * @author Dang Duc Chung
         * @access public
         * @param \Illuminate\Http\Request $request The request containing the hiring data.
         * @return \Illuminate\Http\RedirectResponse A redirect response with a success message after the update.
         */
        public function update(HiringRequest $request, $userId)
        {
                try {
                        $this->hiringService->updateHiring($request, $userId);
                        return Redirect::route('company.manageHiring')->with('status_success', 'Cập nhật thành công');
                } catch (Exception $e) {
                        Log::error($e->getMessage());
                        return back()->with('error', 'Cập nhật nhân viên thất bại');
                }
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
                try {
                        $this->hiringService->deleteHiring($id);
                        return back()->with('status_success', 'Xóa thành công');
                } catch (Exception $e) {
                        Log::error($e->getMessage());
                        return back()->with('error', 'Xóa nhân viên thất bại');
                }
        }
}
