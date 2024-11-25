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
            $workshop->delete();
            return response()->json([
                'code' => 200,
                'message' => __('message.admin.delete_success')
            ], 200);
        }
    }
}
