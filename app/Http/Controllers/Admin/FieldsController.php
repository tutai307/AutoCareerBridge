<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fields\FieldsRequest;
use App\Services\Fields\FieldsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FieldsController extends Controller
{
    protected $fieldService;

    public function __construct(FieldsService $fieldService)
    {
        $this->fieldService = $fieldService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fields = $this->fieldService->getFields();
        return view(
            'management.pages.admin.fields.index',
            [
                'fields' => $fields
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.pages.admin.fields.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FieldsRequest $request)
    {
        try {
            $this->fieldService->createFields($request);
            return redirect()->route('admin.fields.index')->with('status_success', __('message.admin.add_success'));
        } catch (\Exception $e) {
            Log::error('Lỗi  : ' . $e->getMessage());
            return redirect()->route('admin.fields.index')->with('status_error', __('message.admin.add_fail'));
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
        $fields = $this->fieldService->fieldsFirst($id);
        if (empty($fields)) {
            return redirect()->route('admin.fields.index')->with('status_fail', __('message.admin.not_found'));
        }
        return view('management.pages.admin.fields.edit', compact('fields'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FieldsRequest $request, string $id)
    {
        try {
            $this->fieldService->updateFields($request, $id);
            return redirect()->route('admin.fields.index')->with('status_success', __('message.admin.update_success'));
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return redirect()->route('admin.fields.index')->with('status_error', __('message.admin.update_fail'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $field = $this->fieldService->fieldsFirst($id);

        if ($field) {
            if ($field->majors()->count() > 0 || $field->companies()->count() > 0) {
                return response()->json([
                    'code' => 400,
                    'message' => __('message.admin.fields.has_majors')
                ], 400);
            }
            $field->delete();
            return response()->json([
                'code' => 200,
                'message' => __('message.admin.delete_success')
            ], 200);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            $fields = $this->fieldService->changeStatus($request->id, $request->confirm);

            if (empty($fields)) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('message.admin.fields.not_found'),
                ], 400);
            }

            // Xác định thông báo trạng thái dựa trên giá trị trả về
            $text_status = $fields['status'] === STATUS_APPROVED
                ? __('label.admin.fields.status_approved')
                : __('label.admin.fields.status_rejected');

            return response()->json([
                'status' => 'success',
                'message' => __('message.admin.fields.change_status'),
                'text_status' => $text_status,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function getAllFields()
    {
        return $this->fieldService->getAllFields();
    }
}
