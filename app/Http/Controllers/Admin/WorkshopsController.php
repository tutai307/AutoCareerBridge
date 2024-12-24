<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Workshop\WorkshopService;
use Illuminate\Http\Request;

/**
 * The WorkShop Controller is responsible for displaying the list of workshops,
 * searching for workshops, and viewing workshop details.
 *
 * @package App\Http\Controllers\Admin
 * @author Nguyen Manh Hung
 * @access public
 * @see index()
 * @see showBySlug()
 */

class WorkshopsController extends Controller
{
    protected $workshopService;

    public function __construct(WorkshopService $workshopService)
    {
        $this->workshopService = $workshopService;
    }

    public function index(Request $request)
    {
        $data = $request->only(['search', 'status']);
        try {
            $workshops = $this->workshopService->getWorkshops($data);
            return view('management.pages.admin.workshops.index', compact('workshops'));
        } catch (\Exception $e) {
            return redirect()->back()->with('status_fail', $e->getMessage());
        }
    }

    public function showBySlug($slug)
    {
        try {
            $data = $this->workshopService->findWorkshop($slug);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }
}
