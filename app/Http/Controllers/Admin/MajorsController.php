<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Majors\CreateRequest;
use App\Http\Requests\Majors\MajorsRequest;
use App\Http\Requests\Majors\UpdateRequest;
use App\Services\Major\MajorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MajorsController extends Controller
{
    protected $majorService;

    public function __construct(MajorService $majorService)
    {
        $this->majorService = $majorService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fields = $this->majorService->getFields();
        $majors = $this->majorService->getMajorAdmins();
        return view('management.pages.admin.majors.index', compact('majors', 'fields'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fields = $this->majorService->getFields();
        return view('management.pages.admin.majors.create', compact('fields'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MajorsRequest $request)
    {
        try {
            $this->majorService->createMajorAdmin($request);
            return redirect()->route('admin.majors.index')->with('status_success', __('message.admin.add_success'));
        } catch (\Exception $e) {
            Log::error('Lỗi  : ' . $e->getMessage());
            return redirect()->route('admin.majors.index')->with('status_error', __('message.admin.add_fail'));
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
        $major = $this->majorService->majorFind($id);
        $fields = $this->majorService->getFields();

        if (empty($major)) {
            return redirect()->route('admin.majors.index')->with('status_fail', __('message.admin.not_found'));
        }
        return view('management.pages.admin.majors.edit', compact('major', 'fields'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MajorsRequest $request, int $id)
    {
        try {
            $this->majorService->updateMajorAdmin($request, $id);
            return redirect()->route('admin.majors.index')->with('status_success', __('message.admin.update_success'));
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return redirect()->route('admin.majors.index')->with('status_error', __('message.admin.update_fail'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $major = $this->majorService->majorFind($id);
        if ($major) {
            if ($major->universityMajors()->count() > 0) {
                return response()->json([
                    'code' => 400,
                    'message' => __('message.admin.majors.has_university')
                ], 400);
            }
            $major->delete();
            return response()->json([
                'code' => 200,
                'message' => __('message.admin.delete_success')
            ], 200);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            $major = $this->majorService->changeStatus($request->id, $request->confirm);

            if (empty($major)) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('message.admin.fields.not_found'),
                ], 400);
            }

            // Xác định thông báo trạng thái dựa trên giá trị trả về
            $text_status = $major['status'] === STATUS_APPROVED
                ? __('label.admin.fields.status_approved')
                : __('label.admin.fields.status_rejected');

            return response()->json([
                'status' => 'success',
                'message' => __('message.admin.fields.change_status'),
                'text_status' => $text_status,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
