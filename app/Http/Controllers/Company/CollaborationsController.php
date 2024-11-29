<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\Collaboration\CollaborationService;
use Illuminate\Http\Request;

class CollaborationsController extends Controller
{
    protected $collaborationService;

    public function __construct(CollaborationService $collaborationService)
    {
        $this->collaborationService = $collaborationService;
    }

    public function index(Request $request)
    {
        $activeTab = $request->input('active_tab', 'accept');
        $page = $request->input('page', 1);

        $data = $this->collaborationService->getDataByTab($activeTab, $page);
        if ($request->ajax()) {
            return view('management.pages.company.collaboration.table', ['data' => $data['data'], 'status' => $data['status']]);
        }

        return view('management.pages.company.collaboration.index', [
            'pendingRequests' => $data['pending'],
            'accepted' => $data['accepted'],
            'rejected' => $data['rejected'],
            'activeTab' => $activeTab,
            'data' => $data['data'],
        ]);
    }

}
