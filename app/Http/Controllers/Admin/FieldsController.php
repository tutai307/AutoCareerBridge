<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\Fields\FieldsService;
use Illuminate\Http\Request;

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

    public function propose()
    {
        $fields = $this->fieldService->getFieldsPropose();
        return view('management.pages.admin.fields.propose');
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
    public function store(Request $request)
    {
        $this->fieldService->createFields($request);
        return redirect()->route('admin.fields.index')->with('status_success', __('message.admin.add_success'));
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
    public function edit(string $id)
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
    public function update(Request $request, string $id)
    {
        $this->fieldService->updateFields($request, $id);
        return redirect()->route('admin.fields.index')->with('status_success', __('message.admin.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
