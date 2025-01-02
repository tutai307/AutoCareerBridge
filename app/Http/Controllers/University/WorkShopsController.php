<?php

namespace App\Http\Controllers\University;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\University\WorkshopService;
use App\Http\Requests\Workshop\WorkshopEditRequest;
use App\Http\Requests\Workshop\WorkshopCreateRequest;

class WorkShopsController extends Controller
{
    protected $workshopService;
    public function __construct(WorkshopService $workshopService)
    {
        $this->workshopService = $workshopService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'date_range']);
        $workshops = $this->workshopService->getWorkshops($filters);
        return view('management.pages.university.workshops.index', [
            'workshops' => $workshops
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.pages.university.workshops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkshopCreateRequest $request)
    {
        try {
            $workshop = $this->workshopService->createWorkshop($request);
            if ($workshop) {
                return redirect()->route('university.workshop.index')->with('status_success', __('message.admin.add_success'));
            }
        } catch (\Exception $exception) {
            Log::error('Lỗi  : ' . $exception->getMessage());
            return back()->with('status_fail', __('message.admin.add_fail'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $workshop = $this->workshopService->getWorkshop($id);
        if (empty($workshop)) {
            return redirect()->route('university.workshop.index')->with('status_fail', __('message.admin.not_found'));
        }
        return view('management.pages.university.workshops.edit', [
            'workshop' => $workshop
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkshopEditRequest $request, int $id)
    {
        $workshop = $this->workshopService->updateWorkshop($request, $id);
        if ($workshop) {
            return redirect()->route('university.workshop.index')->with('status_success', __('message.admin.update_success'));
        } else {
            return redirect()->route('university.workshop.index')->with('status_fail', __('message.admin.update_fail'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $workshop = $this->workshopService->getWorkshop($id);

        if ($workshop) {
            if ($workshop->companyWorkshops()->exists()) {
                return response()->json([
                    'code' => 400,
                    'message' => __('message.admin.workshop.has_company')
                ]);
            }

            $workshop->delete();
            return response()->json([
                'code' => 200,
                'message' => __('message.admin.delete_success')
            ], 200);
        }
    }

    /**
     * Apply a workshop for a company
     *
     * @param int $companyId Company ID
     * @param int $workshopId WorkShop ID
     * @author Dang Duc Chung
     * @return \Illuminate\Http\RedirectResponse
     */
    public function applyWorkShop($companyId, $workshopId)
    {
        try {
            $this->workshopService->applyWorkShop($companyId, $workshopId);
            return response()->json([
                'code' => 200,
                'message' => 'oke'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Lỗi: ' . $exception->getMessage());
            return back()->with('status_fail', 'Lỗi');
        }
    }

    /**
     * Show the list of workshops applied by companies
     *
     * @author Dang Duc Chung
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageCompanyWorkshop(){
        $companyWorkshops = $this->workshopService->manageCompanyWorkshop();
        $pending = $companyWorkshops['pending'];
        $approved = $companyWorkshops['approved'];
        $rejected = $companyWorkshops['rejected'];
        return view('management.pages.university.company_workshop.index', compact('pending', 'approved', 'rejected'));
    }

/**
 * Update the status of a workshop application for a company.
 *
 * @param int $companyId The ID of the company.
 * @param int $workshopId The ID of the workshop.
 * @param int $status The new status to be updated.
 *
 * @return \Illuminate\Http\RedirectResponse A redirect response to the previous page with a success message.
 *
 * @throws \Exception If the status update process encounters an error.
 */

    public function updateStatus($companyId, $workshopId, $status){
        try {
            $this->workshopService->updateStatusWorkShop($companyId, $workshopId, $status);
            return redirect()->back()->with('status_success', 'Cập nhật trạng thái thành công ');
        } catch (\Exception $exception) {
            Log::error('Lỗi: ' . $exception->getMessage());
        }
    }

    /**
     * Show the list of workshops applied by the current company.
     *
     * @author Dang Duc Chung
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function workshopApplied(){
        try{
            $workshopApplied = $this->workshopService->workshopApplied();
            return view('management.pages.company.workshops.index', compact('workshopApplied'));
        }catch (\Exception $exception) {
            Log::error('Lỗi: ' . $exception->getMessage());
        }
    }
}
